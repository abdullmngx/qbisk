<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('configurations'))
        {
            $settings = Configuration::all();
            $config = [];
            foreach ($settings as $setting) {
                $config[$setting->name] = $setting->value;
            }
            App::singleton('configs', function () use ($config) {
                return $config;
            });
            view()->share('config', $config);
        }
        Paginator::useBootstrapFive();
    }
}
