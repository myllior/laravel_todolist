<?php


return [
    'infrastructure' => [
        \App\Infrastructure\ConfigurationRepository\Contracts\ConfigurationRepositoryInterface::class =>
            \App\Infrastructure\ConfigurationRepository\ConfigurationRepository::class,
        \App\Infrastructure\Container\Contracts\ContainerInterface::class =>
            \App\Infrastructure\Container\Container::class,
    ],
    'application' => [],
    'domain' => [
        \App\Domain\User\User\Contracts\UserRepositoryInterface::class =>
            \App\Infrastructure\Repository\Repositories\UserRepository\UserRepository::class,
        \App\Domain\TodoList\Category\Contracts\CategoryRepositoryInterface::class =>
            \App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\CategoryRepository::class,
        \App\Domain\TodoList\Task\Contracts\TaskRepositoryInterface::class =>
            \App\Infrastructure\Repository\Repositories\TodoList\TaskRepository\TaskRepository::class,
        \App\Domain\User\Token\Contracts\TokenRepositoryInterface::class =>
            \App\Infrastructure\Repository\Repositories\Auth\TokenRepository\TokenRepository::class
    ],
    'presentation' => [
        \App\Presentation\Services\Auth\Contracts\AuthServiceInterface::class =>
            \App\Presentation\Services\Auth\AuthService::class,
        \App\Presentation\Services\Hash\Contracts\HashInterface::class =>
            \App\Presentation\Services\Hash\Hash::class,
        \App\Presentation\Services\Response\Contracts\ResponseInterface::class =>
            \App\Presentation\Services\Response\Response::class
    ]
];
