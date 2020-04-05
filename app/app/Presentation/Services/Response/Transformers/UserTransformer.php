<?php

namespace App\Presentation\Services\Response\Transformers;

use App\Domain\User\User\User;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Collection;

/**
 * Class UserTransformer
 * @package App\Presentation\Services\Response\Transformers
 */
final class UserTransformer extends BaseTransformer
{
    private const RESOURCE_KEY = 'user';

    /**
     * @var array
     */
    protected $availableIncludes = [
        'categories'
    ];

    /**
     * @var CategoryTransformer
     */
    private CategoryTransformer $categoryTransformer;

    /**
     * UserTransformer constructor.
     * @param CategoryTransformer $categoryTransformer
     */
    public function __construct(CategoryTransformer $categoryTransformer)
    {
        $this->categoryTransformer = $categoryTransformer;
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof User;
    }

    /**
     * @param User $model
     * @return array
     */
    protected function transformModel($model): array
    {
        return [
            User::COLUMN_ID => $model->getId(),
            User::COLUMN_NAME => $model->getName(),
            User::COLUMN_EMAIL => $model->getEmail()
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
     * @param User $user
     * @return Collection
     */
    public function includeCategories(User $user): Collection
    {
        $categories = $user->getCategories();

        return $this->collection($categories, $this->categoryTransformer, 'category');
    }
}
