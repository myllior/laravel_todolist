<?php

namespace App\Infrastructure\Repository\Repositories\Auth\TokenRepository;

use App\Domain\User\Token\Token;
use Illuminate\Database\Eloquent\Model;
use App\Infrastructure\Repository\Repository;
use App\Domain\User\Token\Contracts\TokenRepositoryInterface;

/**
 * Class TokenRepository
 * @package App\Infrastructure\Repository\Repositories\Auth\TokenRepository
 */
final class TokenRepository extends Repository implements TokenRepositoryInterface
{
    /**
     * @return Model
     */
    protected function getModelInstance(): Model
    {
        return new Token();
    }
}
