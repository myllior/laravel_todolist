<?php

namespace App\Application\UseCases\TodoList\Categories;

use App\Domain\TodoList\Category\Contracts\CategoryRepositoryInterface;

/**
 * Class DeleteCategory
 * @package App\Application\UseCases\TodoList\Categories
 */
final class DeleteCategory
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $repository;

    /**
     * DeleteCategory constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $params
     * @throws \Exception
     */
    public function handle(array $params): void
    {
        $this->repository->deleteBy($params);
    }
}
