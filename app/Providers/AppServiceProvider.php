<?php

namespace App\Providers;

use App\Models\City;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Locale;
use Session;

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
        Schema::defaultStringLength(191);
        view()->composer('*', function($view)
        {
            $locale = Locale::lang();
            $view->with('locale', $locale);
        });

        view()->composer('layouts.modal', function($view)
        {
            $cities = City::all();
            $view->with('cities', $cities);
        });

        view()->composer('layouts.header', function($view)
        {
            $userSession  = Session::get('user-city');
            if($userSession == null) {
                $user_city = '';
            } else {
               $city =  City::find($userSession);
                $user_city = '<i class="fa fa-map-marker"></i>'.$city->title;
            }

            $user_city = ($user_city == null) ? '' : $user_city;
            $view->with('user_city', $user_city);
        });


    }
}
