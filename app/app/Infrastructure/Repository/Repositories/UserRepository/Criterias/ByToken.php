<?php

namespace App\Infrastructure\Repository\Repositories\UserRepository\Criterias;

use App\Domain\User\User\User;
use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Repository\Contracts\Criteria;

/**
 * Class ByToken
 * @package App\Infrastructure\Repository\Repositories\UserRepository\Criterias
 */
final class ByToken implements Criteria
{
    /**
     * @var string
     */
    private string $tokenId;

    /**
     * ByToken constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->tokenId = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|mixed
     */
    public function apply(Builder $query)
    {
        return $query->whereHas(User::RELATION_TOKENS, function (Builder $query) {
            return $query
                ->where('id', '=', $this->tokenId)
                ->where('revoked', '=', false);
        });
    }
}
