<?php

namespace App\Infrastructure\Repository\Contracts;

/**
 * Interface CompositeCriteria
 * @package App\Infrastructure\Repository\Contracts
 */
interface CompositeCriteria extends Criteria
{
    /**
     * @return mixed
     */
    public function getAllCriteriaList();

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function addCriteria(Criteria $criteria);
}
