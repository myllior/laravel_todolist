<?php

namespace App\Domain\User\Token\Contracts;

use App\Infrastructure\Repository\Contracts\RepositoryInterface;
use App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Contracts\TokenCriteriaDictionary;

/**
 * Interface TokenRepositoryInterface
 * @package App\Domain\User\Token\Contracts
 */
interface TokenRepositoryInterface extends RepositoryInterface, TokenCriteriaDictionary
{

}
