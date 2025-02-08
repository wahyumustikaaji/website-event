<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('events');
            } else {
                // Assign a random profile image
                $profileImages = File::files(public_path('image/profile'));
                $randomImage = !empty($profileImages) ? 'image/profile/' . $profileImages[array_rand($profileImages)]->getFilename() : null;

                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('Password@1234'),
                    'google_id' => $googleUser->id,
                    'profile' => $randomImage
                ]);

                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('events');
                }
            }
        } catch (Exception $e) {
            // Log the exception for troubleshooting
            Log::error('Google Authentication Error:', ['exception' => $e]);
            // You could also redirect to an error page or show a user-friendly message.
            return redirect()->route('error');
        }
    }
}
