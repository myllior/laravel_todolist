<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class IsNull
 * @package App\Infrastructure\Repository\DefaultCriterias
 */
final class IsNull implements Criteria
{
    /**
     * @var string
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
        return $query->whereNull($this->value);
    }
}
