<?php

namespace App\Presentation\Services\Response;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Response as LaravelResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Presentation\Services\Response\Contracts\ResponseInterface;
use App\Presentation\Services\Response\Contracts\TransformerInterface;
use App\Presentation\Services\Response\Exceptions\UndefinedTransformerException;

/**
 * Class Response
 * @package App\Presentation\Services\Response
 */
final class Response implements ResponseInterface
{
    private const SUCCESS_STATUS_CODE = 200;

    /**
     * @var array
     */
    private array $headers = [
        'Content-Type' => 'application/vnd.api+json',
    ];

    /**
     * @var FractalTransformer
     */
    private FractalTransformer $transformer;

    /**
     * @var ResponseFactory
     */
    private ResponseFactory $responseFactory;

    /**
     * @var TransformerFactory
     */
    private TransformerFactory $transformerFactory;

    /**
     * Response constructor.
     * @param FractalTransformer $transformer
     * @param ResponseFactory $responseFactory
     * @param TransformerFactory $transformerFactory
     */
    public function __construct(
        FractalTransformer $transformer,
        ResponseFactory $responseFactory,
        TransformerFactory $transformerFactory
    ) {
        $this->transformer = $transformer;
        $this->responseFactory = $responseFactory;
        $this->transformerFactory = $transformerFactory;
    }

    /**
     * @param array $header
     */
    public function setHeaders(array $header): void
    {
        $this->headers = array_merge($this->headers, $header);
    }

    /**
     * @param string $transformerAlias
     * @param string $item
     * @param array|null $includes
     * @return LaravelResponse
     * @throws BindingResolutionException
     * @throws UndefinedTransformerException
     */
    public function getItem(string $transformerAlias, $item, array $includes = null): LaravelResponse
    {
        $modelTransformer = $this->getModelTransformer($transformerAlias);
        $item = $this->transformer->createItem($item, $modelTransformer);
        $data = $this->createData($item, $includes);

        return $this->makeResponse($data);
    }

    /**
     * @param string $transformerAlias
     * @param string $items
     * @param array|null $includes
     * @return LaravelResponse
     * @throws BindingResolutionException
     * @throws UndefinedTransformerException
     */
    public function getCollection(string $transformerAlias, $items, array $includes = null): LaravelResponse
    {
        $modelTransformer = $this->getModelTransformer($transformerAlias);
        $items = $this->transformer->createCollection($items, $modelTransformer);
        $data = $this->createData($items, $includes);

        return $this->makeResponse($data);
    }

    /**
     * @param string $alias
     * @return TransformerInterface
     * @throws Exceptions\UndefinedTransformerException
     * @throws BindingResolutionException
     */
    private function getModelTransformer(string $alias): TransformerInterface
    {
        return $this->transformerFactory->build($alias);
    }

    /**
     * @param $data
     * @param array|null $includes
     * @return array
     */
    private function createData($data, array $includes = null): array
    {
        return $this->transformer->createData($data, $includes);
    }

    /**
     * @param $data
     * @return LaravelResponse
     */
    private function makeResponse($data): LaravelResponse
    {
        return $this->responseFactory
            ->make($data, self::SUCCESS_STATUS_CODE)
            ->withHeaders($this->headers);
    }
}
