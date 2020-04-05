<?php

namespace App\Domain\User\User\Contracts;

use App\Infrastructure\Repository\Contracts\RepositoryInterface;
use App\Infrastructure\Repository\Repositories\UserRepository\Contracts\UserCriteriaDictionary;

/**
 * Interface UserRepositoryInterface
 * @package App\Domain\User\User\Contracts
 */
interface UserRepositoryInterface extends RepositoryInterface, UserCriteriaDictionary
{

}
