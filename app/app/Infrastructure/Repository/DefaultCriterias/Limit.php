<?php

namespace App\Infrastructure\Repository\DefaultCriterias;

use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Limit
 * @package App\Infrastructure\Repository\DefaultCriterias
 */
final class Limit implements Criteria
{
    /**
     * @var int
     */
    private $value;

    /**
     * Limit constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query)
    {
        return $query->limit($this->value);
    }
}
