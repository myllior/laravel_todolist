<?php

namespace App\Presentation\Controllers\TodoList\Categories;

use Illuminate\Http\Response;
use App\Domain\TodoList\Category\Category;
use App\Presentation\Controllers\Controller;
use App\Application\UseCases\TodoList\Categories\CreateCategory;
use App\Presentation\Services\Response\Contracts\ResponseInterface;
use App\Presentation\Requests\TodoList\Categories\CreateCategoryRequest;

/**
 * Class CreateCategoryController
 * @package App\Presentation\Controllers\TodoList\Categories
 */
final class CreateCategoryController extends Controller
{
    private const TRANSFORMER_ALIAS = 'category';

    /**
     * @var CreateCategory
     */
    private CreateCategory $useCase;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * CreateCategoryController constructor.
     * @param CreateCategory $useCase
     * @param ResponseInterface $response
     */
    public function __construct(CreateCategory $useCase, ResponseInterface $response)
    {
        $this->useCase = $useCase;
        $this->response = $response;
    }

    /**
     * @param CreateCategoryRequest $request
     * @param int $userId
     * @return Response
     */
    public function __invoke(CreateCategoryRequest $request, int $userId): Response
    {
        $category = $this->useCase->handle(array_merge(
            $request->validated(),
            [Category::COLUMN_USER_ID => $userId]
        ));

        return $this->response->getItem(
            self::TRANSFORMER_ALIAS,
            $category
        );
    }
}
