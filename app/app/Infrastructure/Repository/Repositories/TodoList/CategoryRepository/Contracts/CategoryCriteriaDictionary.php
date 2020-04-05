<?php

namespace App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\Contracts;

use App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary;

/**
 * Interface CategoryCriteriaDictionary
 * @package App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\Contracts
 */
interface CategoryCriteriaDictionary extends DefaultCriteriaDictionary
{
    public const BY_USER_ID = 'user_id';
}
