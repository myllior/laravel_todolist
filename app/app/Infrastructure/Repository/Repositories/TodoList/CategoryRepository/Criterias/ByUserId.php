<?php

namespace App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\Criterias;

use Illuminate\Database\Eloquent\Builder;
use App\Domain\TodoList\Category\Category;
use App\Infrastructure\Repository\Contracts\Criteria;

/**
 * Class ByUserId
 * @package App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\Criterias
 */
final class ByUserId implements Criteria
{
    /**
     * @var int
     */
    private int $userId;

    /**
     * ByUserId constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->userId = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|mixed
     */
    public function apply(Builder $query)
    {
        return $query->where(Category::COLUMN_USER_ID, '=', $this->userId);
    }
}
