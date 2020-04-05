<?php

namespace App\Presentation\Services\Response\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Collection;
use App\Domain\TodoList\Category\Category;

/**
 * Class CategoryTransformer
 * @package App\Presentation\Services\Response\Transformers
 */
final class CategoryTransformer extends BaseTransformer
{
    private const RESOURCE_KEY = 'category';

    /**
     * @var array
     */
    protected $availableIncludes = [
        'tasks'
    ];

    /**
     * @var TaskTransformer
     */
    private TaskTransformer $taskTransformer;

    /**
     * CategoryTransformer constructor.
     * @param TaskTransformer $taskTransformer
     */
    public function __construct(TaskTransformer $taskTransformer)
    {
        $this->taskTransformer = $taskTransformer;
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof Category;
    }

    /**
     * @param Category $model
     * @return array
     */
    protected function transformModel($model): array
    {
        return [
            Category::COLUMN_ID => $model->getId(),
            Category::COLUMN_TEXT => $model->getText()
        ];
    }

    /**
     * @return string
     */
    public function getResourceKey(): string
    {
        return self::RESOURCE_KEY;
    }

    /**
     * @param Category $category
     * @return Collection
     */
    public function includeTasks(Category $category): Collection
    {
        $tasks = $category->getTasks();

        return $this->collection($tasks, $this->taskTransformer, 'task');
    }
}
