<?php

namespace App\Application\UseCases\TodoList\Categories;

use App\Domain\TodoList\Category\Category;
use App\Domain\TodoList\Category\Contracts\CategoryRepositoryInterface;

/**
 * Class CreateCategory
 * @package App\Application\UseCases\TodoList\Categories
 */
final class CreateCategory
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $repository;

    /**
     * CreateCategory constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $params
     * @return Category
     */
    public function handle(array $params): Category
    {
        return $this->repository->create($params);
    }
}
