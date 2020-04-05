<?php

namespace App\Presentation\Requests\TodoList\Categories;

use App\Domain\TodoList\Category\Category;
use App\Presentation\Requests\FormRequest;

/**
 * Class CreateCategoryRequest
 * @package App\Presentation\Requests\TodoList\Categories
 */
final class CreateCategoryRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            Category::COLUMN_TEXT => 'required|string|max:256'
        ];
    }
}
