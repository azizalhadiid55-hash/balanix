<?php

use App\Http\Middleware\admin;
use App\Http\Middleware\member;
use App\Http\Middleware\subcription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => admin::class,
            'member' => member::class,
            'subscription' => subcription::class,
        ]);
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(function ($request) {
        $user = Auth::user();

            return match (true) {
                $user?->role === 'admin'  => route('admin.dashbaord.index'),
                $user?->role === 'member' => route('dashboard.index'),
                default => '/',
            };
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (ThrottleRequestsException $e, $request) {
            return redirect()->back()->withErrors(['msg' => 'Terlalu banyak percobaan, silahkan coba lagi nanti.']);
        });
    })->create();
