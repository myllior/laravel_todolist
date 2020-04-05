<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class KeyIn
 * @package App\Infrastructure\Repository\DefaultCriterias
 */
final class KeyIn implements Criteria
{
    /**
     * @var
     */
    private $value;

    /**
     * ByKey constructor.
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
        return $query->whereIn($query->getModel()->getKeyName(), $this->value);
    }
}
