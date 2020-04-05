<?php

namespace App\Infrastructure\Container;

use Illuminate\Contracts\Container\BindingResolutionException;
use App\Infrastructure\Container\Contracts\ContainerInterface;
use Illuminate\Contracts\Container\Container as LaravelContainer;

/**
 * Class Container
 * @package App\Infrastructure\Container
 */
final class Container implements ContainerInterface
{
    /**
     * @var LaravelContainer
     */
    private LaravelContainer $container;

    /**
     * Container constructor.
     * @param LaravelContainer $container
     */
    public function __construct(LaravelContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $className
     * @param array $parameters
     * @return mixed
     * @throws BindingResolutionException
     */
    public function make(string $className, array $parameters = [])
    {
        return $this->container->make($className, $parameters);
    }
}
