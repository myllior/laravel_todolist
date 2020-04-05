<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class WithRelation
 * @package App\Infrastructure\Repository\DefaultCriterias
 */
class WithRelation implements Criteria
{
    private $value;

    /**
     * WithRelation constructor.
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
        return $query->with($this->value);
    }
}
