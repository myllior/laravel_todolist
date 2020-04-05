<?php

namespace App\Presentation\Services\Response;

use App\Infrastructure\Container\Contracts\ContainerInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Presentation\Services\Response\Contracts\TransformerInterface;
use App\Presentation\Services\Response\Exceptions\UndefinedTransformerException;
use App\Infrastructure\ConfigurationRepository\Contracts\ConfigurationRepositoryInterface;

/**
 * Class TransformerFactory
 * @package App\Presentation\Services\Response
 */
class TransformerFactory
{
    private const CONFIG = 'response_transformers';

    /**
     * @var array
     */
    private array $transformers;

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * TransformerFactory constructor.
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
        $this->transformers = $configurationRepository->get(self::CONFIG, []);
    }

    /**
     * @param string $alias
     * @return TransformerInterface
     * @throws BindingResolutionException
     * @throws UndefinedTransformerException
     */
    public function build(string $alias): TransformerInterface
    {
        if (! isset($this->transformers[$alias])) {
            throw new UndefinedTransformerException(sprintf(
                'Can not build transformer with alias %s',
                $alias
            ));
        }

        return $this->getTransformer($alias);
    }

    /**
     * @param string $alias
     * @return TransformerInterface
     * @throws BindingResolutionException
     */
    private function getTransformer(string $alias): TransformerInterface
    {
        return $this->container->make($this->transformers[$alias]);
    }
}
