<?php

namespace App\Domain\TodoList\Task;

use Illuminate\Database\Eloquent\Model;
use App\Domain\TodoList\Category\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Task
 * @package App\Domain\TodoList\Task
 */
final class Task extends Model
{
    public const COLUMN_ID = 'id';
    public const COLUMN_TEXT = 'text';
    public const COLUMN_CATEGORY_ID = 'category_id';
    public const COLUMN_IS_COMPLETED = 'is_completed';

    public const RELATION_CATEGORY = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_TEXT,
        self::COLUMN_CATEGORY_ID,
        self::COLUMN_IS_COMPLETED,
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
    public function getCategoryId(): int
    {
        return $this->getAttribute(self::COLUMN_CATEGORY_ID);
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->setAttribute(self::COLUMN_CATEGORY_ID, $categoryId);
    }

    /**
     * @return bool
     */
    public function getIsCompleted(): bool
    {
        return $this->getAttribute(self::COLUMN_IS_COMPLETED);
    }

    /**
     * @param bool $isCompleted
     */
    public function setIsCompleted(bool $isCompleted): void
    {
        $this->setAttribute(self::COLUMN_IS_COMPLETED, $isCompleted);
    }

    /*
     *------------------------------------------------------------------------------------------------------------------
     *                                              RELATIONS
     *------------------------------------------------------------------------------------------------------------------
     */

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }
}
