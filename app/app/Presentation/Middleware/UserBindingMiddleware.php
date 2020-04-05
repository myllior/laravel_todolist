<?php

namespace App\Presentation\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Presentation\Services\Auth\Contracts\AuthServiceInterface;

/**
 * Class ApiTokenMiddleware
 * @package App\Presentation\Middleware
 */
class UserBindingMiddleware
{
    /**
     * @var AuthServiceInterface
     */
    private AuthServiceInterface $authService;

    /**
     * UserBindingMiddleware constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Middleware handler
     *
     * @param Request $request Request instance
     * @param Closure $next Closure instance
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if ($token) {
            $user = $this->authService->getCurrentUser($token);
            $request->merge(['user' => $user]);
        }

        return $next($request);
    }
}
