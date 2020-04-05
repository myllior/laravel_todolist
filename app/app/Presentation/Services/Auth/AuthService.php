<?php

namespace App\Presentation\Services\Auth;

use Lcobucci\JWT\Parser;
use App\Domain\User\User\User;
use App\Domain\User\Token\Token;
use App\Domain\User\User\Contracts\UserRepositoryInterface;
use App\Presentation\Services\Hash\Contracts\HashInterface;
use App\Domain\User\Token\Contracts\TokenRepositoryInterface;
use App\Presentation\Services\Auth\Contracts\AuthServiceInterface;

/**
 * Class AuthService
 * @package App\Presentation\Services\Auth
 */
final class AuthService implements AuthServiceInterface
{
    private const CLAIM_TYPE = 'jti';
    private const TOKEN_NAME = 'Personal Access';

    /**
     * @var HashInterface
     */
    private HashInterface $hash;

    /**
     * @var Parser
     */
    private Parser $tokenParser;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var TokenRepositoryInterface
     */
    private TokenRepositoryInterface $tokenRepository;

    /**
     * AuthService constructor.
     * @param HashInterface $hash
     * @param Parser $tokenParser
     * @param UserRepositoryInterface $userRepository
     * @param TokenRepositoryInterface $tokenRepository
     */
    public function __construct(
        HashInterface $hash,
        Parser $tokenParser,
        UserRepositoryInterface $userRepository,
        TokenRepositoryInterface $tokenRepository
    ) {
        $this->hash = $hash;
        $this->tokenParser = $tokenParser;
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * @param User $user
     */
    public function logout(User $user): void
    {
        $this->revokeTokensIfExists($user);
    }

    /**
     * @param array $params
     * @return string|null
     */
    public function login(array $params): ?string
    {
        $user = $this->getUserByEmail($params[User::COLUMN_EMAIL]);
        $this->revokeTokensIfExists($user);

        return $this->isUserCorrect($user, $params[User::COLUMN_PASSWORD])
            ? $this->createToken($user)
            : null;
    }

    /**
     * @param array $params
     * @return string|null
     */
    public function register(array $params): ?string
    {
        $params[User::COLUMN_PASSWORD] = $this->hashPassword($params[User::COLUMN_PASSWORD]);
        $user = $this->createUser($params);

        return $this->createToken($user);
    }

    /**
     * @param string $token
     * @return User|null
     */
    public function getCurrentUser(string $token): ?User
    {
        $token = $this->parseToken($token);

        return $this->getUserByToken($token);
    }

    /**
     * @param User $user
     */
    private function revokeTokensIfExists(User $user): void
    {
        $token = $this->getTokenByUserId($user->getId());
        if ($token) {
            $token->revoke();
        }
    }

    /**
     * @param int $userId
     * @return Token|null
     */
    private function getTokenByUserId(int $userId): ?Token
    {
        return $this->tokenRepository->getFirstBy([
            $this->tokenRepository::BY_USER_ID => $userId,
            $this->tokenRepository::BY_REVOKED_STATUS => false
        ]);
    }

    /**
     * @param string $token
     * @return string
     */
    private function parseToken(string $token): string
    {
        $token = $this->tokenParser->parse($token);

        return $token->getClaim(self::CLAIM_TYPE);
    }

    /**
     * @param string $token
     * @return User|null
     */
    private function getUserByToken(string $token): ?User
    {
        return $this->userRepository->getFirstBy([
            $this->userRepository::BY_TOKEN => $token
        ]);
    }

    /**
     * @param string $email
     * @return User|null
     */
    private function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->getFirstBy([
            $this->userRepository::BY_EMAIL => $email
        ]);
    }

    /**
     * @param User|null $user
     * @param string $password
     * @return bool
     */
    private function isUserCorrect(?User $user, string $password): bool
    {
        return $user && $this->hash->check($password, $user->getPassword());
    }

    /**
     * @param User $user
     * @return string
     */
    private function createToken(User $user): string
    {
        return $user->createToken(self::TOKEN_NAME)->accessToken;
    }

    /**
     * @param array $params
     * @return User
     */
    private function createUser(array $params): User
    {
        return $this->userRepository->create($params);
    }

    /**
     * @param string $password
     * @return string
     */
    private function hashPassword(string $password): string
    {
        return $this->hash->make($password);
    }
}
