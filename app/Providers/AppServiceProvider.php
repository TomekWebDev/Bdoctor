<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Configuration as Braintree_Configuration;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $braintreeConfig = config('braintree');

        Braintree_Configuration::environment($braintreeConfig['environment']);
        Braintree_Configuration::merchantId($braintreeConfig['merchantId']);
        Braintree_Configuration::publicKey($braintreeConfig['publicKey']);
        Braintree_Configuration::privateKey($braintreeConfig['privateKey']);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
