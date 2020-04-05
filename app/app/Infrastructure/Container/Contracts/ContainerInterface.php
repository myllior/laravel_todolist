<?php

namespace App\Infrastructure\Container\Contracts;

use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Interface ContainerInterface
 * @package App\Infrastructure\Container\Contracts
 */
interface ContainerInterface
{
    /**
     * @param string $className
     * @param array $parameters
     * @return mixed
     * @throws BindingResolutionException
     */
    public function make(string $className, array $parameters = []);
}
