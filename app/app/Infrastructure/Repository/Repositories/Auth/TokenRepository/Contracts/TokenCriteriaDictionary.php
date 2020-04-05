<?php

namespace App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Contracts;

/**
 * Interface TokenCriteriaDictionary
 * @package App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Contracts
 */
interface TokenCriteriaDictionary
{
    public const BY_USER_ID = 'user_id';
    public const BY_REVOKED_STATUS = 'revoked';
}
