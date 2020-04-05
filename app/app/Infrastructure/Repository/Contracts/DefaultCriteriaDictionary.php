<?php

namespace App\Infrastructure\Repository\Contracts;

/**
 * Interface DefaultCriteriaDictionary
 * @package App\Infrastructure\Repository\Contracts
 */
interface DefaultCriteriaDictionary
{
    public const BY_KEY = 'id';
    public const KEY_IN = 'key_in';
    public const WITH_RELATION = 'include_relation';
    public const WITH_DELETED = 'with_deleted';
    public const BY_RELATION = 'relation';
    public const ONLY_ID = 'only_id';
    public const LIMIT = 'limit';
    public const OR_CRITERIA = 'or_criteria';
    public const AND_CRITERIA = 'and_criteria';
    public const IS_NULL = 'is_null';
    public const SORT_BY = 'sort_by';
}
