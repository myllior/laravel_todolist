<?php

namespace App\Domain\User\User;

use App\Domain\TodoList\Task\Task;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Domain\TodoList\Category\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class User
 * @package App\Domain\User\User
 */
final class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_EMAIL = 'email';
    public const COLUMN_PASSWORD = 'password';

    public const RELATION_TASKS = 'tasks';
    public const RELATION_TOKENS = 'tokens';
    public const RELATION_CATEGORIES = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_EMAIL,
        self::COLUMN_PASSWORD,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        self::COLUMN_PASSWORD,
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
    public function getName(): string
    {
        return $this->getAttribute(self::COLUMN_NAME);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->setAttribute(self::COLUMN_NAME, $name);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getAttribute(self::COLUMN_PASSWORD);
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->setAttribute(self::COLUMN_PASSWORD, $password);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getAttribute(self::COLUMN_EMAIL);
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->setAttribute(self::COLUMN_EMAIL, $email);
    }

    /*
     *------------------------------------------------------------------------------------------------------------------
     *                                              RELATIONS
     *------------------------------------------------------------------------------------------------------------------
     */

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @return HasManyThrough
     */
    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, Category::class);
    }

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    /**
     * @return Collection
     */
    private function getTokens(): Collection
    {
        return $this->tokens;
    }
}
