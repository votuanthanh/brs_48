<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('authUser', Auth::user());
        });

        Blade::directive('switch', function ($condition) {
            return '<?php switch (' . $condition . ') { ';
        });

        Blade::directive('firstcase', function ($value) {
            return 'case '. $value . ':  ?>';
        });

        Blade::directive('case', function ($value) {
            return '<?php  case ' . $value . ':  ?>';
        });

        Blade::directive('breakcase', function () {
            return '<?php break; ?>';
        });

        Blade::directive('whatever', function () {
            return '<?php default : ?>';
        });

        Blade::directive('endswitch', function () {
            return '<?php }  ?>';
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
