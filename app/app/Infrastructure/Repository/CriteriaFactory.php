<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Infrastructure\Container\Contracts\ContainerInterface;
use App\Infrastructure\Repository\Exceptions\CriteriaFactoryException;
use App\Infrastructure\ConfigurationRepository\Contracts\ConfigurationRepositoryInterface;

/**
 * Class CriteriaFactory
 * @package App\Infrastructure\Repository
 */
class CriteriaFactory
{
    private const CONFIG = 'repository.criterias';
    private const DEFAULT_CRITERIAS_CONTEXT = 'default';

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * @var array
     */
    private array $criterias;

    /**
     * CriteriaFactory constructor.
     * @param ContainerInterface $container
     * @param ConfigurationRepositoryInterface $configurationRepository
     */
    public function __construct(
        ContainerInterface $container,
        ConfigurationRepositoryInterface $configurationRepository
    ) {
        $this->container = $container;

        $this->configure($configurationRepository);
    }

    /**
     * @param ConfigurationRepositoryInterface $configurationRepository
     */
    private function configure(ConfigurationRepositoryInterface $configurationRepository): void
    {
        $this->criterias = $configurationRepository->get(self::CONFIG, []);
    }

    /**
     * @param string $context
     * @param string $alias
     * @param $value
     * @return Criteria
     * @throws BindingResolutionException
     * @throws CriteriaFactoryException
     */
    public function build(string $context, string $alias, $value): Criteria
    {
        $className = $this->getCriteriaClass($context, $alias);
        if (! $className) {
            throw new CriteriaFactoryException(sprintf(
                'Can\'t find criteria by context - %s and alias - %s',
                $context,
                $alias
            ));
        }

        return $this->getInstance($className, $value);
    }

    /**
     * @param string $context
     * @param string $alias
     * @return string|null
     */
    private function getCriteriaClass(string $context, string $alias): ?string
    {
        if (isset($this->criterias[$context][$alias])) {
            return $this->criterias[$context][$alias];
        } elseif (isset($this->criterias[self::DEFAULT_CRITERIAS_CONTEXT][$alias])) {
            return $this->criterias[self::DEFAULT_CRITERIAS_CONTEXT][$alias];
        }

        return null;
    }

    /**
     * @param string $className
     * @param $value
     * @return Criteria
     * @throws BindingResolutionException
     */
    private function getInstance(string $className, $value): Criteria
    {
        return $this->container->make($className, ['value' => $value]);
    }
}
