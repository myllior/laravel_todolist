<?php

namespace App\Presentation\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use App\Presentation\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Presentation\Requests\Auth\RegisterRequest;
use App\Presentation\Services\Auth\Contracts\AuthServiceInterface;

/**
 * Class RegisterController
 * @package App\Presentation\Controllers\Auth
 */
final class RegisterController extends Controller
{
    /**
     * @var AuthServiceInterface
     */
    private AuthServiceInterface $authService;

    /**
     * RegisterController constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $token = $this->authService->register($request->validated());

        return response()->json(
            ['token' => $token],
            Response::HTTP_OK
        );
    }
}
