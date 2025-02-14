<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPremiumStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(Auth::user()->id);

        if ($user->hasActivePremium()) {
            $remainingDays = now()->diffInDays($user->subscription_expires_at);
            return redirect()->route('pricing')
                ->with('error', "You are still in premium period. Your premium will expire in {$remainingDays} days.");
        }

        return $next($request);
    }
}
