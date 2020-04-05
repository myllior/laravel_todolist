<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class GetOnlyId implements Criteria
{
    private $value;

    /**
     * GetOnlyId constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $query
     * @return \Illuminate\Support\Collection|mixed
     */
    public function apply(Builder $query)
    {
        if ($this->value) {
            return $query->select('id');
        }

        return $query;
    }

}
