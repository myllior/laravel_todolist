<?php

namespace App\Presentation\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Presentation\Controllers\Controller;
use App\Presentation\Services\Auth\Contracts\AuthServiceInterface;

/**
 * Class LogoutController
 * @package App\Presentation\Controllers\Auth
 */
final class LogoutController extends Controller
{
    /**
     * @var AuthServiceInterface
     */
    private AuthServiceInterface $authService;

    /**
     * LogoutController constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $this->authService->logout($request->user);

        return response()->noContent();
    }
}
