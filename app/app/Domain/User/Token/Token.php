<?php

namespace App\Domain\User\Token;

use App\Domain\User\User\User;
use Laravel\Passport\Token as LaravelToken;

/**
 * Class Token
 * @package App\Domain\User\Token
 */
final class Token extends LaravelToken
{
    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_USER_ID = 'user_id';
    public const COLUMN_IS_REVOKED = 'revoked';

    /*
     *------------------------------------------------------------------------------------------------------------------
     *                                              PROPERTIES
     *------------------------------------------------------------------------------------------------------------------
     */

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttribute(self::COLUMN_ID);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute(self::COLUMN_NAME);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->setAttribute(self::COLUMN_NAME, $name);
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->getAttribute(self::COLUMN_USER_ID);
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->setAttribute(self::COLUMN_USER_ID, $userId);
    }

    /**
     * @return bool
     */
    public function getIsRevoked(): bool
    {
        return $this->getAttribute(self::COLUMN_IS_REVOKED);
    }

    /**
     * @param bool $isRevoked
     */
    public function setIsRevoked(bool $isRevoked): void
    {
        $this->setAttribute(self::COLUMN_IS_REVOKED, $isRevoked);
    }

    /*
     *------------------------------------------------------------------------------------------------------------------
     *                                              RELATIONS
     *------------------------------------------------------------------------------------------------------------------
     */

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
