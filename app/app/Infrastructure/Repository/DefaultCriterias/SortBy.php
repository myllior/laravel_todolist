<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Repository\Contracts\Criteria;

/**
 * Class SortBy
 * @package App\Infrastructure\Repository\DefaultCriterias
 */
final class SortBy implements Criteria
{
    private $value;

    /**
     * SortByDateDesc constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $query
     * @return mixed|void
     */
    public function apply(Builder $query)
    {
        foreach ($this->value as $sorting) {
            $query->orderBy($sorting['field'], $sorting['order']);
        }

        return $query;
    }
}
