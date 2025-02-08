<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ambil daftar gambar dari folder public/image/profile
        $profileImages = File::files(public_path('image/profile'));

        // Pilih gambar secara acak jika tersedia, jika tidak, gunakan gambar default
        $randomImage = count($profileImages) > 0
            ? 'image/profile/' . $profileImages[array_rand($profileImages)]->getFilename()
            : 'image/profile/default.png'; // Pastikan ada default.png di folder tersebut

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile' => $randomImage, // Simpan path gambar ke database
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('events', absolute: false));
    }
}
