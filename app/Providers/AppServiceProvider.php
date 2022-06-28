<?php



namespace App\Providers;



use ConsoleTVs\Charts\Registrar as Charts;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\URL;

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

        Schema::defaultStringLength(191);

    }



    /**

     * Bootstrap any application services.

     *

     * @return void

     */

    public function boot( )

    {

        if(env('FORCE_HTTPS',false)) { // Default value should be false for local server

            URL::forceScheme('https');

        }

    }

}

