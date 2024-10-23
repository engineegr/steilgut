<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use App\Models\UserRole;

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
        Blade::if('administratorRole', function () {
            // print_r(request()->user());
            return request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0]);
        });

        Blade::if('guestRole', function () {
            return request()->user()->hasRole(UserRole::$USER_ROLE_DICT[1]);
        });

        Paginator::useBootstrap();
    }
}
