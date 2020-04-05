<?php

namespace App\Application\UseCases\TodoList\Categories;

use App\Domain\TodoList\Category\Category;
use App\Domain\TodoList\Category\Contracts\CategoryRepositoryInterface;

/**
 * Class UpdateCategory
 * @package App\Application\UseCases\TodoList\Categories
 */
final class UpdateCategory
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $repository;

    /**
     * UpdateCategory constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $criterias
     * @param array $params
     * @return Category
     */
    public function handle(array $criterias, array $params): Category
    {
        $category = $this->getCategory($criterias);

        return $this->updateCategory($category, $params);
    }

    /**
     * @param array $criterias
     * @return Category
     */
    private function getCategory(array $criterias): Category
    {
        return $this->repository->getFirstBy($criterias);
    }

    /**
     * @param Category $category
     * @param array $params
     * @return Category
     */
    private function updateCategory(Category $category, array $params): Category
    {
        return $this->repository->update($category, $params);
    }
}
