<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('currency', function ($expression) {
            return "<?php echo 'Rp ' . number_format($expression, 0, ',', '.'); ?>";
        });

        Carbon::setLocale('id');

        // <-- Tambahkan blok kode ini untuk Railway -->
        // Memaksa Laravel menggunakan HTTPS jika diakses di environment production
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
