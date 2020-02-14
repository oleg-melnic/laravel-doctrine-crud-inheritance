<?php

namespace App\Providers;

use App\Crud\Inheritance\Inheritance;
use App\Crud\InheritanceAwareInterface;
use Illuminate\Support\ServiceProvider;

class InheritanceAwareProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(
            InheritanceAwareInterface::class,
            function ($service) {

                if (!$service instanceof InheritanceAwareInterface) {
                    return false;
                }

                /** @var Inheritance $inheritanceStrategy */
                $inheritanceStrategy = app(Inheritance::class);

                foreach ($service->getServicesNames() as $strategyName => $value) {
                    $inheritanceStrategy->registerStrategy($strategyName, app($value));
                }

                $inheritanceStrategy->setDiscriminatorName($service->getDiscriminatorName());
                $inheritanceStrategy->setBaseEntityName($service->getBaseEntityName());

                $service->setInheritanceResolver($inheritanceStrategy);

                return $service;
            }
        );
    }
}
