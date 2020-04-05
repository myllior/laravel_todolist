<?php

namespace App\Presentation\Controllers\TodoList\Categories;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\TodoList\Category\Category;
use App\Presentation\Controllers\Controller;
use App\Application\UseCases\TodoList\Categories\DeleteCategory;

/**
 * Class DeleteCategoryController
 * @package App\Presentation\Controllers\TodoList\Categories
 */
final class DeleteCategoryController extends Controller
{
    /**
     * @var DeleteCategory
     */
    private DeleteCategory $useCase;

    /**
     * DeleteCategoryController constructor.
     * @param DeleteCategory $useCase
     */
    public function __construct(DeleteCategory $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $userId
     * @param int $categoryId
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request, int $userId, int $categoryId)
    {
        $this->useCase->handle([
            Category::COLUMN_USER_ID => $userId,
            Category::COLUMN_ID => $categoryId
        ]);

        return response()->noContent();
    }
}
