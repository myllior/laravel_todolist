<?php

namespace App\Infrastructure\ConfigurationRepository;

use App\Infrastructure\ConfigurationRepository\Contracts\ConfigurationRepositoryInterface;

/**
 * Class ConfigurationRepository
 * @package App\Infrastructure\ConfigurationRepository
 */
final class ConfigurationRepository implements ConfigurationRepositoryInterface
{
    /**
     * @param string $config
     * @param null $defaultValue
     * @return mixed
     * @codeCoverageIgnore
     */
    public function get(string $config, $defaultValue = null)
    {
        return config($config, $defaultValue);
    }
}
