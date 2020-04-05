<?php

namespace App\Infrastructure\Repository;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Repository\Contracts\Criteria;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Infrastructure\Repository\Contracts\CompositeCriteria;
use App\Infrastructure\Repository\Contracts\RepositoryInterface;
use App\Infrastructure\Repository\Exceptions\CriteriaFactoryException;

/**
 * Class Repository
 * @package App\Infrastructure\Repository
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var array
     */
    protected array $cascadeDelete = [];

    /**
     * @var array
     */
    private array $criterias;

    /**
     * @var Builder
     */
    private Builder $queryBuilder;

    /**
     * @var CriteriaFactory
     */
    private CriteriaFactory $criteriaFactory;

    /**
     * @return Model
     */
    abstract protected function getModelInstance(): Model;

    /**
     * Repository constructor.
     * @param CriteriaFactory $criteriaFactory
     */
    public function __construct(CriteriaFactory $criteriaFactory)
    {
        $this->criteriaFactory = $criteriaFactory;
        $this->model = $this->getModelInstance();
        $this->queryBuilder = $this->model->newQuery();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        $this->refreshBuilder();

        return $this->queryBuilder->get();
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function save(Model $model): bool
    {
        return $model->save();
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws Exception
     */
    public function delete(Model $model): ?bool
    {
        foreach ($this->cascadeDelete as $relation) {
            $model->{$relation}()->delete();
        }

        return $model->delete();
    }

    /**
     * @param array $criterias
     * @return bool|null
     * @throws Exception
     */
    public function deleteBy(array $criterias): ?bool
    {
        $this->buildRequest($criterias);

        return $this->queryBuilder->delete();
    }

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model
    {
        return $this->queryBuilder->create($params);
    }

    /**
     * @param array $criterias
     * @return Model|null
     * @throws BindingResolutionException
     * @throws CriteriaFactoryException
     */
    public function getFirstBy(array $criterias): ?Model
    {
        $this->buildRequest($criterias);

        return $this->queryBuilder->first();
    }

    /**
     * @param array $criterias
     * @return Collection
     * @throws BindingResolutionException
     * @throws CriteriaFactoryException
     */
    public function getAllBy(array $criterias): Collection
    {
        $this->buildRequest($criterias);

        return $this->queryBuilder->get();
    }

    /**
     * @param Model $model
     * @param array $params
     * @return Model
     */
    public function update(Model $model, array $params): Model
    {
        $model->update($params);

        return $model->fresh();
    }

    /**
     * @param array $criterias
     * @param array $params
     * @return int - the number of rows affected
     * @throws BindingResolutionException
     * @throws CriteriaFactoryException
     */
    public function updateByCriteria(array $criterias, array $params): int
    {
        $this->buildRequest($criterias);

        return $this->queryBuilder->update($params);
    }

    /**
     * @param array $criterias
     * @param int $perPage
     * @return LengthAwarePaginator
     * @throws BindingResolutionException
     * @throws CriteriaFactoryException
     */
    public function getPaginatedBy(array $criterias, int $perPage): LengthAwarePaginator
    {
        $this->buildRequest($criterias);

        return $this->queryBuilder->paginate($perPage);
    }

    /**
     * @param array $criterias
     * @throws BindingResolutionException
     * @throws CriteriaFactoryException
     */
    private function buildRequest(array $criterias): void
    {
        $this->refreshBuilder();
        $this->buildCriteris($criterias);
        $this->applyCriterias();
    }

    private function refreshBuilder(): void
    {
        $this->queryBuilder = $this->model->newQuery();
        $this->criterias = [];
    }

    /**
     * @param array $criterias
     * @throws BindingResolutionException
     * @throws CriteriaFactoryException
     */
    private function buildCriteris(array $criterias): void
    {
        foreach ($criterias as $criteria => $value) {
            $this->criterias[] = $this->buildCriteria($criteria, $value);
        }
    }

    /**
     * @param string $criteria
     * @param $value
     * @return Criteria
     * @throws Exceptions\CriteriaFactoryException
     * @throws BindingResolutionException
     */
    private function buildCriteria(string $criteria, $value): Criteria
    {
        $buildedCriteria = $this->criteriaFactory->build(static::class, $criteria, $value);
        if ($buildedCriteria instanceof CompositeCriteria) {
            $criteriasList = $buildedCriteria->getAllCriteriaList();
            foreach ($criteriasList as $criteria => $value) {
                $nestedCriteria = $this->buildCriteria($criteria, $value);
                $buildedCriteria->addCriteria($nestedCriteria);
            }
        }

        return $buildedCriteria;
    }

    private function applyCriterias(): void
    {
        foreach ($this->criterias as $criteria) {
            $this->queryBuilder = $criteria->apply($this->queryBuilder);
        }
    }
}
