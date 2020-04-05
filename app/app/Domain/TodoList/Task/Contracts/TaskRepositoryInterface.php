<?php

namespace App\Domain\TodoList\Task\Contracts;

use App\Infrastructure\Repository\Contracts\RepositoryInterface;
use App\Infrastructure\Repository\Repositories\TodoList\TaskRepository\Contracts\TaskCriteriaDictionary;

/**
 * Interface TaskRepositoryInterface
 * @package App\Domain\TodoList\Task\Contracts
 */
interface TaskRepositoryInterface extends RepositoryInterface, TaskCriteriaDictionary
{

}
