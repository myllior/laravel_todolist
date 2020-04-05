<?php

namespace App\Presentation\Services\Response\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface TransformerItem
 * @package App\Presentation\Services\Response\Contracts
 */
interface TransformerInterface
{
    /**
     * @param Model $model
     * @return array
     */
    public function transform(Model $model): array;

    /**
     * @return string
     */
    public function getResourceKey(): string;
}
