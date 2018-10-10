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
        view()->composer('*', function($view) {

            $locations = DB::table('providers')->select('Country')->where('Country', '!=', '')->distinct()->get();

            $specialist = DB::table('providers')->select('specialty')->where('specialty', '!=', '')->get();
            $as_specialist = array();
            foreach ($specialist as $as_value) {            
                foreach ($as_value as $value) {                
                    foreach (explode(',', $value) as $un) {
                        $as_specialist[] = $un;
                    }
                }
            }
            $as_specialist = array_unique($as_specialist);

            $view->with(['as_locations' => $locations,'as_specialist' => $as_specialist]);
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
