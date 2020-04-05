<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use App\Infrastructure\Repository\Contracts\CompositeCriteria;
use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class OrCriteria implements CompositeCriteria
{

    /**
     * @var array
     */
    private $allCriteriasList;
    /**
     * @var Criteria[]
     */
    private $criterias;

    /**
     * CompositeCriteria constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->allCriteriasList = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|mixed
     */
    public function apply(Builder $query)
    {
        $query->where(function (Builder $query) {
            foreach ($this->criterias as $criteria) {
                $query->orWhere(function (Builder $query) use ($criteria) {
                    $query = $criteria->apply($query);
                });
            }
        });

        return $query;
    }

    /**
     * @return mixed
     */
    public function getAllCriteriaList()
    {
        return $this->allCriteriasList;
    }

    /**
     * @param Criteria $criteria
     * @return mixed|void
     */
    public function addCriteria(Criteria $criteria)
    {
        $this->criterias [] = $criteria;
    }
}
