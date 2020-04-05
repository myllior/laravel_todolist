<?php

namespace App\Presentation\Controllers\TodoList\Categories;

use Illuminate\Http\Response;
use App\Domain\TodoList\Category\Category;
use App\Presentation\Controllers\Controller;
use App\Application\UseCases\TodoList\Categories\UpdateCategory;
use App\Presentation\Services\Response\Contracts\ResponseInterface;
use App\Presentation\Requests\TodoList\Categories\UpdateCategoryRequest;

/**
 * Class UpdateCategoryController
 * @package App\Presentation\Controllers\TodoList\Categories
 */
final class UpdateCategoryController extends Controller
{
    private const TRANSFORMER_ALIAS = 'category';

    /**
     * @var UpdateCategory
     */
    private UpdateCategory $useCase;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * UpdateCategoryController constructor.
     * @param UpdateCategory $useCase
     * @param ResponseInterface $response
     */
    public function __construct(UpdateCategory $useCase, ResponseInterface $response)
    {
        $this->useCase = $useCase;
        $this->response = $response;
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param int $userId
     * @param int $categoryId
     * @return Response
     */
    public function __invoke(UpdateCategoryRequest $request, int $userId, int $categoryId): Response
    {
        $category = $this->useCase->handle(
            [Category::COLUMN_ID => $categoryId, Category::COLUMN_USER_ID => $userId],
            $request->validated()
        );

        return $this->response->getItem(
            self::TRANSFORMER_ALIAS,
            $category,
            $request->get('include')
        );
    }
}
