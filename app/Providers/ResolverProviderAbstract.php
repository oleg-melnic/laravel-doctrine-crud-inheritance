<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

abstract class ResolverProviderAbstract extends ServiceProvider
{
    /**
     * Получить префикс, на который реагирует фабрика
     * @return string
     */
    abstract protected function getPrefix();

    /**
     * Вычислить имя сервиса из запроса
     * @param $requestedName
     *
     * @return string
     */
    protected function getServiceName($requestedName)
    {
        return class_basename($requestedName);
    }
}
