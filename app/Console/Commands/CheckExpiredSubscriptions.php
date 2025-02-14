<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckExpiredSubscriptions extends Command
{
    /**
     * Nama perintah yang bisa dipanggil via Artisan
     */
    protected $signature = 'subscriptions:check-expired';

    /**
     * Deskripsi perintah
     */
    protected $description = 'Cek dan nonaktifkan langganan premium yang sudah expired';

    /**
     * Jalankan perintah Artisan ini
     */
    public function handle()
    {
        $expiredUsers = User::where('is_premium', true)
            ->where('subscription_expires_at', '<', now())
            ->get();

        foreach ($expiredUsers as $user) {
            $user->update([
                'is_premium' => false,
                'subscription_expires_at' => null
            ]);

            Log::info('Premium subscription expired:', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
        }

        $this->info("Successfully checked and updated {$expiredUsers->count()} expired subscriptions.");
    }
}
