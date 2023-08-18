<?php

namespace App\Providers;

use App\Models\Ta;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $ta = Ta::get();
        View::share('provider_ta', $ta);
    }
}
