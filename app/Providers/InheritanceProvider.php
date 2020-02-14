<?php

namespace App\Providers;

use App\Crud\Inheritance\Inheritance;

class InheritanceProvider extends ResolverProviderAbstract
{
    const PREFIX = 'Crud\Resolver\Inheritance\\';

    protected function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Inheritance::class, function ($service) {
            return new Inheritance($this->getServiceName($service));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
