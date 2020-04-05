<?php

return [
    'default' => [
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::BY_KEY =>
            \App\Infrastructure\Repository\DefaultCriterias\ByKey::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::WITH_RELATION =>
            \App\Infrastructure\Repository\DefaultCriterias\WithRelation::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::BY_RELATION =>
            \App\Infrastructure\Repository\DefaultCriterias\ByRelation::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::WITH_DELETED =>
            \App\Infrastructure\Repository\DefaultCriterias\WithDeleted::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::LIMIT =>
            \App\Infrastructure\Repository\DefaultCriterias\Limit::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::KEY_IN =>
            \App\Infrastructure\Repository\DefaultCriterias\KeyIn::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::ONLY_ID =>
            \App\Infrastructure\Repository\DefaultCriterias\GetOnlyId::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::OR_CRITERIA =>
            \App\Infrastructure\Repository\DefaultCriterias\OrCriteria::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::IS_NULL =>
            \App\Infrastructure\Repository\DefaultCriterias\IsNull::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::AND_CRITERIA =>
            \App\Infrastructure\Repository\DefaultCriterias\AndCriteria::class,
        \App\Infrastructure\Repository\Contracts\DefaultCriteriaDictionary::SORT_BY =>
            \App\Infrastructure\Repository\DefaultCriterias\SortBy::class
    ],
    \App\Infrastructure\Repository\Repositories\UserRepository\UserRepository::class => [
        \App\Infrastructure\Repository\Repositories\UserRepository\Contracts\UserCriteriaDictionary::BY_EMAIL =>
            \App\Infrastructure\Repository\Repositories\UserRepository\Criterias\ByEmail::class,
        \App\Infrastructure\Repository\Repositories\UserRepository\Contracts\UserCriteriaDictionary::BY_TOKEN =>
            \App\Infrastructure\Repository\Repositories\UserRepository\Criterias\ByToken::class
    ],
    \App\Infrastructure\Repository\Repositories\Auth\TokenRepository\TokenRepository::class => [
        \App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Contracts\TokenCriteriaDictionary::BY_USER_ID =>
            \App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Criterias\ByUserId::class,
        \App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Contracts\TokenCriteriaDictionary::BY_REVOKED_STATUS =>
            \App\Infrastructure\Repository\Repositories\Auth\TokenRepository\Criterias\ByRevokedStatus::class
    ],
    \App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\CategoryRepository::class => [
        \App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\Contracts\CategoryCriteriaDictionary::BY_USER_ID =>
            \App\Infrastructure\Repository\Repositories\TodoList\CategoryRepository\Criterias\ByUserId::class
    ]
];
