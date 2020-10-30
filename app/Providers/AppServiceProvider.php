<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;



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
        Blade::if('national_id', function () {
            $user = Auth::user();
            if($user->national_id == "0"){
                return true;
            }
            return false;
        });

        Blade::if('gender', function () {
            $user = Auth::user();
            if($user->gender == null){
                return true;
            }
            return false;
        });
    }
}
