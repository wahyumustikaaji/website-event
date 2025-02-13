<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    private const PRO_PLAN_PRICE = 50000;
    private const TAX_RATE = 0.1; // 10%

    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Membuat transaksi charge dan mendapatkan snap token
     */
    public function createCharge(Request $request)
    {
        $user = Auth::user();
        $amount = self::PRO_PLAN_PRICE;
        $taxAmount = $amount * self::TAX_RATE;
        $totalAmount = $amount + $taxAmount;
        $orderId = 'ORDER-' . time() . '-' . $user->id;

        // Buat record pembayaran
        $payment = Payment::create([
            'user_id'      => $user->id,
            'order_id'     => $orderId,
            'amount'       => $amount,
            'tax_amount'   => $taxAmount,
            'total_amount' => $totalAmount,
            'status'       => 'pending'
        ]);

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $totalAmount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
                'phone'      => $request->phone ?? '',
            ],
            'item_details' => [
                [
                    'id'       => 'PRO_PLAN',
                    'price'    => $amount,
                    'quantity' => 1,
                    'name'     => 'Pro Plan Subscription',
                ],
                [
                    'id'       => 'TAX',
                    'price'    => $taxAmount,
                    'quantity' => 1,
                    'name'     => 'Tax (10%)',
                ]
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $payment->update(['snap_token' => $snapToken]);

        return response()->json([
            'snap_token' => $snapToken,
            'order_id'   => $orderId
        ]);
    }

    /**
     * Callback dari Midtrans untuk update status pembayaran
     */
    public function handleCallback(Request $request)
    {
        try {
            Log::info('Payment callback received:', $request->all());

            $serverKey = config('midtrans.server_key');
            $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            if ($hashed == $request->signature_key) {
                DB::beginTransaction();

                $payment = Payment::where('order_id', $request->order_id)->lockForUpdate()->first();

                if (!$payment) {
                    Log::error('Payment not found for order_id: ' . $request->order_id);
                    return response()->json(['message' => 'Payment not found'], 404);
                }

                $payment->payment_type = $request->payment_type;
                $payment->payment_details = $request->all();

                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $payment->status = 'success';
                    $payment->paid_at = now();

                    // Update status premium pada user
                    $user = User::where('id', $payment->user_id)->lockForUpdate()->first();
                    if ($user) {
                        $user->is_premium = true;
                        $user->subscription_expires_at = Carbon::now()->addMonth();
                        $user->save();

                        Log::info('User premium status updated:', [
                            'user_id'   => $user->id,
                            'is_premium' => $user->is_premium,
                            'expires_at' => $user->subscription_expires_at
                        ]);
                    }
                } elseif ($request->transaction_status == 'pending') {
                    $payment->status = 'pending';
                } else {
                    $payment->status = 'failed';
                }

                $payment->save();
                DB::commit();

                Log::info('Payment status updated successfully:', [
                    'order_id' => $payment->order_id,
                    'status'   => $payment->status
                ]);

                return response()->json(['message' => 'Payment updated successfully']);
            }

            Log::warning('Invalid signature received for order_id: ' . $request->order_id);
            return response()->json(['message' => 'Invalid signature'], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in handleCallback: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing payment'], 500);
        }
    }

    /**
     * Halaman sukses. Jika status pembayaran belum ter-update,
     * kita cek status terbaru dari Midtrans melalui API dan update data di database.
     */
    public function success(Request $request)
    {
        $orderId = $request->order_id;
        $payment = Payment::where('order_id', $orderId)->first();

        if (!$payment) {
            abort(404, "Payment not found.");
        }

        // Jika status pembayaran masih pending atau belum sukses, cek status melalui API Midtrans
        if ($payment->status !== 'success') {
            $client = new Client();
            $serverKey = config('midtrans.server_key');
            $auth = base64_encode($serverKey . ':');

            try {
                $response = $client->request('GET', "https://api.sandbox.midtrans.com/v2/{$orderId}/status", [
                    'headers' => [
                        'accept'        => 'application/json',
                        'Authorization' => 'Basic ' . $auth,
                    ],
                ]);

                $statusResponse = json_decode($response->getBody(), true);
                $transactionStatus = $statusResponse['transaction_status'] ?? null;

                DB::beginTransaction();
                // Simpan detail response dari API Midtrans
                $payment->payment_details = $statusResponse;

                if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                    $payment->status = 'success';
                    $payment->paid_at = now();

                    // Update user premium jika belum aktif
                    $user = User::where('id', $payment->user_id)->lockForUpdate()->first();
                    if ($user && !$user->is_premium) {
                        $user->is_premium = true;
                        $user->subscription_expires_at = Carbon::now()->addMonth();
                        $user->save();

                        Log::info('User premium status updated via success method:', [
                            'user_id'   => $user->id,
                            'is_premium' => $user->is_premium,
                            'expires_at' => $user->subscription_expires_at
                        ]);
                    }
                } elseif ($transactionStatus == 'pending') {
                    $payment->status = 'pending';
                } else {
                    $payment->status = 'failed';
                }

                $payment->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Error checking Midtrans status in success method: " . $e->getMessage());
                // Jika terjadi error, tetap lanjutkan untuk menampilkan view dengan data yang ada
            }
        }

        // Refresh data payment terbaru
        $payment->refresh();

        return view('payment.success', [
            'payment' => $payment
        ]);
    }

    /**
     * Menangani notifikasi yang dikirim oleh Midtrans secara asinkron
     */
    public function notification(Request $request)
    {
        try {
            Log::info('Payment notification received:', $request->all());

            DB::beginTransaction();

            $notification = new Notification();

            $payment = Payment::where('order_id', $notification->order_id)->lockForUpdate()->first();

            if (!$payment) {
                Log::error('Payment not found for order_id: ' . $notification->order_id);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            // Simpan detail pembayaran dari notifikasi
            $payment->payment_details = $notification->getResponse();
            $payment->payment_type = $notification->payment_type;

            // Update status berdasarkan notifikasi Midtrans
            switch ($notification->transaction_status) {
                case 'capture':
                case 'settlement':
                    $payment->status = 'success';
                    $payment->paid_at = now();

                    // Update user premium status
                    $user = User::where('id', $payment->user_id)->lockForUpdate()->first();
                    if ($user) {
                        $user->is_premium = true;
                        $user->subscription_expires_at = Carbon::now()->addMonth();
                        $user->save();

                        Log::info('User premium status updated via notification:', [
                            'user_id'   => $user->id,
                            'is_premium' => $user->is_premium,
                            'expires_at' => $user->subscription_expires_at
                        ]);
                    }
                    break;

                case 'pending':
                    $payment->status = 'pending';
                    break;

                case 'deny':
                case 'expire':
                case 'cancel':
                    $payment->status = 'failed';
                    break;
            }

            $payment->save();
            DB::commit();

            Log::info('Payment notification processed successfully:', [
                'order_id' => $payment->order_id,
                'status'   => $payment->status
            ]);

            return response()->json(['message' => 'Payment notification handled successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in notification: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }
}
