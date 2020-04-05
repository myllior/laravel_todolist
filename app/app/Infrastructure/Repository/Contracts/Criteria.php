<?php

namespace App\Infrastructure\Repository\Contracts;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Criteria
 * @package App\Infrastructure\Repository\Contracts
 */
interface Criteria
{
    /**
     * @param Builder $query
     * @return mixed
     */
    public function apply(Builder $query);
}
