<?php

namespace App\Presentation\Services\Response\Contracts;

use Illuminate\Http\Response as LaravelResponse;

/**
 * Interface ResponseInterface
 * @package App\Presentation\Services\Response\Contracts
 */
interface ResponseInterface
{
    /**
     * @param array $header
     */
    public function setHeaders(array $header): void;

    /**
     * @param string $transformerAlias
     * @param string $item
     * @param array|null $includes
     * @return LaravelResponse
     */
    public function getItem(string $transformerAlias, $item, array $includes = null): LaravelResponse;

    /**
     * @param string $transformerAlias
     * @param string $items
     * @param array|null $includes
     * @return LaravelResponse
     */
    public function getCollection(string $transformerAlias, $items, array $includes = null): LaravelResponse;
}
