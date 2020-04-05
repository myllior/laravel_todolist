<?php

namespace App\Infrastructure\ConfigurationRepository\Contracts;

/**
 * Interface ConfigurationRepositoryInterface
 * @package App\Infrastructure\ConfigurationRepository\Contracts
 */
interface ConfigurationRepositoryInterface
{
    /**
     * @param string $config
     * @param null $defaultValue
     * @return mixed
     */
    public function get(string $config, $defaultValue = null);
}
