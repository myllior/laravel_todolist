<?php

namespace App\Infrastructure\Repository\Contracts;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface RepositoryInterface
 * @package App\Infrastructure\Repository\Contracts
 */
interface RepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param Model $model
     * @return bool
     */
    public function save(Model $model): bool;

    /**
     * @param Model $model
     * @return bool|null
     * @throws Exception
     */
    public function delete(Model $model): ?bool;

    /**
     * @param array $criterias
     * @return bool|null
     * @throws Exception
     */
    public function deleteBy(array $criterias): ?bool;

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params): Model;

    /**
     * @param array $criterias
     * @return Model|null
     */
    public function getFirstBy(array $criterias): ?Model;

    /**
     * @param array $criterias
     * @return Collection
     */
    public function getAllBy(array $criterias): Collection;

    /**
     * @param Model $model
     * @param array $params
     * @return Model
     */
    public function update(Model $model, array $params): Model;

    /**
     * @param array $criterias
     * @param array $params
     * @return int - the number of rows affected
     */
    public function updateByCriteria(array $criterias, array $params): int;

    /**
     * @param array $criterias
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedBy(array $criterias, int $perPage): LengthAwarePaginator;
}
