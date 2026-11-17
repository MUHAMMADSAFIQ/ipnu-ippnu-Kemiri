<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if(config('app.env') !== 'local' || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                    $settings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
                    $view->with('settings', $settings);
                }
                if (\Illuminate\Support\Facades\Schema::hasTable('footer_links')) {
                    $footerLinks = \App\Models\FooterLink::active()->get();
                    $view->with('footerLinks', $footerLinks);
                }
            } catch (\Throwable $e) {
                // Fail gracefully during initial installation/migration
            }
        });
    }
}
