<?php

namespace App\Application\UseCases\TodoList\Categories;

use App\Domain\TodoList\Category\Category;
use App\Domain\TodoList\Category\Contracts\CategoryRepositoryInterface;

/**
 * Class GetCategory
 * @package App\Application\UseCases\TodoList\Categories
 */
final class GetCategory
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $repository;

    /**
     * GetCategory constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    /**
     * @param array $params
     * @return Category|null
     */
    public function handle(array $params): ?Category
    {
        return $this->repository->getFirstBy($params);
    }
}
