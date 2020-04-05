<?php

namespace App\Infrastructure\Repository\Repositories\UserRepository;

use App\Domain\User\User\User;
use Illuminate\Database\Eloquent\Model;
use App\Infrastructure\Repository\Repository;
use App\Domain\User\User\Contracts\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Infrastructure\Repository\Repositories\UserRepository
 */
final class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * @return Model
     */
    protected function getModelInstance(): Model
    {
        return new User();
    }
}
