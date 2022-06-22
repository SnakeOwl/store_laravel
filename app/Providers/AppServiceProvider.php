<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Slider_v1;
use App\View\Components\Mini_catalog_v1;
use App\View\Components\Storages_list_v1;



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
        Blade::directive('headerRouteActive', function ($route ){
            return "<?php echo Route::currentRouteNamed($route) ? 'link-secondary' :  'link-dark' ?>";
        });

        Blade::if('admin', function (){
            return Auth::check() && Auth::user()->is_admin();
        });
        Blade::if('editor', function (){
            return Auth::check() && Auth::user()->is_editor();
        });
        Blade::if('courier', function (){
            return Auth::check() && Auth::user()->is_courier();
        });

        Blade::component('slider-v1', Slider_v1::class);
        Blade::component('mini-catalog-v1', Mini_catalog_v1::class);
        Blade::component('storages-list-v1', Storages_list_v1::class);
    }
}
