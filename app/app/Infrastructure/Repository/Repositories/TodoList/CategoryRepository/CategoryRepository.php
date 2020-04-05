<?php

namespace App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository;

use Illuminate\Database\Eloquent\Model;
use App\Domain\TodoList\Category\Category;
use App\Infrastructure\Repository\Repository;
use App\Domain\TodoList\Category\Contracts\CategoryRepositoryInterface;

/**
 * Class CategoryRepository
 * @package App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository
 */
final class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    /**
     * @return Model
     */
    protected function getModelInstance(): Model
    {
        return new Category();
    }
}
