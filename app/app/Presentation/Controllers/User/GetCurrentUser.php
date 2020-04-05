<?php

namespace App\Presentation\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Presentation\Controllers\Controller;
use App\Presentation\Services\Response\Contracts\ResponseInterface;

/**
 * Class GetCurrentUser
 * @package App\Presentation\Controllers\User
 */
final class GetCurrentUser extends Controller
{
    private const TRANSFORMER_ALIAS = 'user';

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * GetCurrentUser constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->response->getItem(self::TRANSFORMER_ALIAS, $request->user);
    }
}
