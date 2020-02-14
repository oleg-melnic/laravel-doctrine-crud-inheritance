<?php

namespace App\Providers;

use App\Crud\CustomHydratorAwareInterface;
use App\Crud\Inheritance\NoInheritance;
use App\Crud\NoInheritanceAwareInterface;
use App\Crud\Translatable\Simple;
use Illuminate\Support\ServiceProvider;
use Laminas\Hydrator\ClassMethodsHydrator;
use Zend\Hydrator\ClassMethods;

class NoInheritanceAwareProvider extends ServiceProvider
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
            NoInheritanceAwareInterface::class,
            function ($service) {

                if (!$service instanceof NoInheritanceAwareInterface) {
                    return false;
                }

                /** @var NoInheritance $resolver */
                $resolver = app(NoInheritance::class);

                $strategy = new Simple();
                $resolver->setLanguageStrategy($strategy);
                $resolver->setBaseEntityName($service->getBaseEntityName());
                $resolver->setEntityFactory($service);
                if ($service instanceof CustomHydratorAwareInterface) {
                    $resolver->setHydrator(app($service->getHydratorName()));
                } else {
                    $resolver->setHydrator(new ClassMethodsHydrator(false));
                }

                $service->setInheritanceResolver($resolver);

                return $service;
            }
        );
    }
}
