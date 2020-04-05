<?php

namespace App\Presentation\Controllers\TodoList\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\TodoList\Category\Category;
use App\Presentation\Controllers\Controller;
use App\Application\UseCases\TodoList\Categories\GetCategories;
use App\Presentation\Services\Response\Contracts\ResponseInterface;

/**
 * Class GetCategoriesController
 * @package App\Presentation\Controllers\TodoList\Categories
 */
final class GetCategoriesController extends Controller
{
    private const TRANSFORMER_ALIAS = 'category';

    /**
     * @var GetCategories
     */
    private GetCategories $useCase;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * GetCategoriesController constructor.
     * @param GetCategories $useCase
     * @param ResponseInterface $response
     */
    public function __construct(GetCategories $useCase, ResponseInterface $response)
    {
        $this->useCase = $useCase;
        $this->response = $response;
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return Response
     */
    public function __invoke(Request $request, int $userId): Response
    {
        $categories = $this->useCase->handle([
            Category::COLUMN_USER_ID => $userId,
        ]);

        return $this->response->getCollection(
            self::TRANSFORMER_ALIAS,
            $categories,
            $request->get('include')
        );
    }
}
