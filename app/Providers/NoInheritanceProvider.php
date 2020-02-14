<?php

namespace App\Providers;

use App\Crud\Inheritance\NoInheritance;

class NoInheritanceProvider extends ResolverProviderAbstract
{
    const PREFIX = 'Crud\Resolver\NoInheritance\\';

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
        $this->app->bind(NoInheritance::class, function ($requestedName) {
            return new NoInheritance($this->getServiceName($requestedName));
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
