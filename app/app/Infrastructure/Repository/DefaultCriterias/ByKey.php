<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Repository\Contracts\Criteria;

/**
 * Class ByKey
 * @package App\Infrastructure\Repository\DefaultCriterias
 */
final class ByKey implements Criteria
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * ByKey constructor.
     * @param mixed $value
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
        return $query->where($query->getModel()->getKeyName(), $this->value);
    }
}
