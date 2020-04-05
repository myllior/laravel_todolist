<?php

namespace App\Application\UseCases\TodoList\Categories;

use Illuminate\Support\Collection;
use App\Domain\TodoList\Category\Contracts\CategoryRepositoryInterface;

/**
 * Class GetCategories
 * @package App\Application\UseCases\TodoList\Categories
 */
final class GetCategories
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $repository;

    /**
     * GetCategories constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $params
     * @return Collection
     */
    public function handle(array $params): Collection
    {
        return $this->repository->getAllBy($params);
    }
}
