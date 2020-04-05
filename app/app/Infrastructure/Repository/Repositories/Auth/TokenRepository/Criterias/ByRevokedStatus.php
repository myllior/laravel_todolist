<?php

namespace App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Criterias;

use App\Domain\User\Token\Token;
use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Repository\Contracts\Criteria;

/**
 * Class ByRevokedStatus
 * @package App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Criterias
 */
final class ByRevokedStatus implements Criteria
{
    /**
     * @var bool
     */
    private bool $isRevoked;

    /**
     * ByRevokedStatus constructor.
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->isRevoked = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|mixed
     */
    public function apply(Builder $query)
    {
        return $query->where(Token::COLUMN_IS_REVOKED, '=', $this->isRevoked);
    }
}
