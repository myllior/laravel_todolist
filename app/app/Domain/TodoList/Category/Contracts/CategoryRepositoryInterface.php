<?php

namespace App\Domain\TodoList\Category\Contracts;

use App\Infrastructure\Repository\Contracts\RepositoryInterface;
use App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\Contracts\CategoryCriteriaDictionary;

/**
 * Interface CategoryRepositoryInterface
 * @package App\Domain\TodoList\Category\Contracts
 */
interface CategoryRepositoryInterface extends RepositoryInterface, CategoryCriteriaDictionary
{

}
