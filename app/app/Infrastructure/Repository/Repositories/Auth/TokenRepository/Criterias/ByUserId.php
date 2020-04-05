<?php

namespace App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Criterias;

use App\Domain\User\Token\Token;
use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Repository\Contracts\Criteria;

/**
 * Class ByUserId
 * @package App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Criterias
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
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        return $query->where(Token::COLUMN_USER_ID, '=', $this->userId);
    }
}
