<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class WithDeleted implements Criteria
{
    private $value;

    /**
     * WithDeleted constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|mixed
     */
    public function apply(Builder $query)
    {
        return $this->value
            ? $query->withTrashed()
            : $query;
    }

}
