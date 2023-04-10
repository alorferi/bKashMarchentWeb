<?php

namespace App\Providers;

use App\Models\Option;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer(['layouts.admin','layouts.guest'], function ($view) {
            $defaultLibraryName = null;
            $defaultLibraryId = null;

           $blogname = Option::where('option_name',Option::blogname)->first();
           $blogdescription = Option::where('option_name',Option::blogdescription)->first();

            $view->with(compact('blogname','blogdescription'));
        });
    }
}
