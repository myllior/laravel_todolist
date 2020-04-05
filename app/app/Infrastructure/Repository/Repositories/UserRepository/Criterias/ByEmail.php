<?php

namespace App\Infrastructure\Repository\Repositories\UserRepository\Criterias;

use App\Domain\User\User\User;
use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Repository\Contracts\Criteria;

/**
 * Class ByEmail
 * @package App\Infrastructure\Repository\Repositories\UserRepository\Criterias
 */
final class ByEmail implements Criteria
{
    /**
     * @var string
     */
    private string $value;

    /**
     * ByEmail constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|mixed
     */
    public function apply(Builder $query)
    {
        return $query->where(User::COLUMN_EMAIL, '=', $this->value);
    }
}
