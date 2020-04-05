<?php

namespace App\Presentation\Controllers\TodoList\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\TodoList\Category\Category;
use App\Presentation\Controllers\Controller;
use App\Application\UseCases\TodoList\Categories\GetCategory;
use App\Presentation\Services\Response\Contracts\ResponseInterface;

/**
 * Class GetCategoryController
 * @package App\Presentation\Controllers\TodoList\Categories
 */
final class GetCategoryController extends Controller
{
    private const TRANSFORMER_ALIAS = 'category';

    /**
     * @var GetCategory
     */
    private GetCategory $useCase;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * GetCategoryController constructor.
     * @param GetCategory $useCase
     * @param ResponseInterface $response
     */
    public function __construct(GetCategory $useCase, ResponseInterface $response)
    {
        $this->useCase = $useCase;
        $this->response = $response;
    }

    /**
     * @param Request $request
     * @param int $userId
     * @param int $categoryId
     * @return Response
     */
    public function __invoke(Request $request, int $userId, int $categoryId): Response
    {
        $category = $this->useCase->handle([
            Category::COLUMN_USER_ID => $userId,
            Category::COLUMN_ID => $categoryId
        ]);

        return $this->response->getItem(
            self::TRANSFORMER_ALIAS,
            $category,
            $request->get('include')
        );
    }
}
