<?php

namespace App\Providers;

use App\Jugador;
use App\Observers\JugadorObserver;
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
        Jugador::observe(JugadorObserver::class);
    }
}
