<?php

namespace App\Domain\TodoList\Category;

use App\Domain\User\User\User;
use Illuminate\Support\Collection;
use App\Domain\TodoList\Task\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Category
 * @package App\Domain\TodoList\Category
 */
final class Category extends Model
{
    public const COLUMN_ID = 'id';
    public const COLUMN_TEXT = 'text';
    public const COLUMN_USER_ID = 'user_id';

    public const RELATION_USER = 'user';
    public const RELATION_TASKs = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_TEXT,
        self::COLUMN_USER_ID
    ];

    /*
     *------------------------------------------------------------------------------------------------------------------
     *                                              PROPERTIES
     *------------------------------------------------------------------------------------------------------------------
     */

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttribute(self::COLUMN_ID);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->getAttribute(self::COLUMN_TEXT);
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->setAttribute(self::COLUMN_TEXT, $text);
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->getAttribute(self::COLUMN_USER_ID);
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->setAttribute(self::COLUMN_USER_ID, $userId);
    }

    /*
     *------------------------------------------------------------------------------------------------------------------
     *                                              RELATIONS
     *------------------------------------------------------------------------------------------------------------------
     */

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }
}
