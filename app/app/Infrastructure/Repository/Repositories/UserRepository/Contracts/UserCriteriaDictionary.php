<?php

namespace App\Infrastructure\Repository\Repositories\UserRepository\Contracts;

use App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary;

/**
 * Interface UserCriteriaDictionary
 * @package App\Infrastructure\Repository\Repositories\UserRepository\Contracts
 */
interface UserCriteriaDictionary extends DefaultCriteriaDictionary
{
    public const BY_EMAIL = 'email';
    public const BY_TOKEN = 'token';
}
