<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $user = \Auth::user();
            $isDoctor = false;
            if($user){
                $isDoctor = $user->group_id === 2 ? true : false;
                $view->with('isDoctor', $isDoctor);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
