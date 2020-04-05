<?php

namespace App\Presentation\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class BindingServiceProvider
 * @package App\Presentation\Providers
 */
class InterfaceBindingServiceProvider extends ServiceProvider
{
    private const CONFIG = 'bindings';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $bindings = config(self::CONFIG);

        $this->bind($bindings);
    }

    /**
     * @param array $bindingTypes
     */
    protected function bind(array $bindingTypes)
    {
        foreach ($bindingTypes as $bindingType) {
            $this->bindByType($bindingType);
        }
    }

    /**
     * @param array $bindingType
     */
    protected function bindByType(array $bindingType)
    {
        foreach ($bindingType as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
