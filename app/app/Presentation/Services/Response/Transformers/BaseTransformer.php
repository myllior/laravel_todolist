<?php

namespace App\Presentation\Services\Response\Transformers;

use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;
use App\Presentation\Services\Response\Contracts\TransformerInterface;

/**
 * Class BaseTransformer
 * @package App\Presentation\Services\Response\Transformers
 */
abstract class BaseTransformer extends TransformerAbstract implements TransformerInterface
{
    /**
     * @param Model $model
     * @return array
     */
    public function transform(Model $model): array
    {
        if (! $this->isSatisfy($model)) {
            throw new InvalidArgumentException(sprintf(
                'Invalid model instance for %s transformer given',
                static::class
            ));
        }

        return $this->transformModel($model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    abstract protected function isSatisfy(Model $model): bool;

    /**
     * @param $model
     * @return array
     */
    abstract protected function transformModel($model): array;
}
