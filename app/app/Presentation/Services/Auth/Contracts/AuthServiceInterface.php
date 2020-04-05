<?php

namespace App\Presentation\Services\Auth\Contracts;

use App\Domain\User\User\User;

/**
 * Interface AuthServiceInterface
 * @package App\Presentation\Services\Auth\Contracts
 */
interface AuthServiceInterface
{
    /**
     * @param User $user
     */
    public function logout(User $user): void;

    /**
     * @param array $params
     * @return string|null
     */
    public function login(array $params): ?string;

    /**
     * @param array $params
     * @return string|null
     */
    public function register(array $params): ?string;

    /**
     * @param string $token
     * @return User|null
     */
    public function getCurrentUser(string $token): ?User;
}
