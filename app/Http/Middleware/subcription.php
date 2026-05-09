<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class subcription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$packages) // ← variadic parameter
    {
        $user = Auth::user();
        $active = optional($user->getLatestActiveSubscription())->paket;
        $isOnTrial = $user->isOnTrial();
        if ($isOnTrial && ! $active) {
            $active = 'TRIAL';
        }

        if (! $active || ! in_array(strtoupper($active), array_map('strtoupper', $packages))) {
            return redirect()->back()->with(
                'error',
                "Anda tidak memiliki akses fitur ini. Silahkan hubungi admin untuk mengganti paket."
            );
        }

        return $next($request);
    }
}
