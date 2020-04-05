<?php

namespace App\Presentation\Services\Response\Transformers;

use App\Domain\TodoList\Task\Task;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskTransformer
 * @package App\Presentation\Services\Response\Transformers
 */
final class TaskTransformer extends BaseTransformer
{
    private const RESOURCE_KEY = 'task';

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof Task;
    }

    /**
     * @param Task $model
     * @return array
     */
    protected function transformModel($model): array
    {
        return [
            Task::COLUMN_ID => $model->getId(),
            Task::COLUMN_TEXT => $model->getText()
        ];
    }

    /**
     * @return string
     */
    public function getResourceKey(): string
    {
        return self::RESOURCE_KEY;
    }
}
