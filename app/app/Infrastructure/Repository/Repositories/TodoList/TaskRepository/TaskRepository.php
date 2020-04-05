<?php

namespace App\Infrastructure\Repository\Repositories\TodoList\TaskRepository;

use App\Domain\TodoList\Task\Task;
use Illuminate\Database\Eloquent\Model;
use App\Infrastructure\Repository\Repository;
use App\Domain\TodoList\Task\Contracts\TaskRepositoryInterface;

/**
 * Class TaskRepository
 * @package App\Infrastructure\Repository\Repositories\TodoList\TaskRepository
 */
final class TaskRepository extends Repository implements TaskRepositoryInterface
{
    /**
     * @return Model
     */
    protected function getModelInstance(): Model
    {
        return new Task();
    }
}
