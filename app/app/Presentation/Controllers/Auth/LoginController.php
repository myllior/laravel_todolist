<?php

namespace App\Presentation\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use App\Presentation\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Presentation\Requests\Auth\LoginRequest;
use App\Presentation\Services\Auth\Contracts\AuthServiceInterface;

/**
 * Class LoginController
 * @package App\Presentation\Controllers\Auth
 */
final class LoginController extends Controller
{
    /**
     * @var AuthServiceInterface
     */
    private AuthServiceInterface $authService;

    /**
     * LoginController constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $token = $this->authService->login($request->validated());
        if ($token) {
            return response()->json(
                ['token' => $token],
                Response::HTTP_OK
            );
        }

        return response()->json(
            ['errors' => ['Invalid email or password']],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
