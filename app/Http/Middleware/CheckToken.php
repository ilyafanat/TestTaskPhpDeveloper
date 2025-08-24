<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\TemporaryUserService;

class CheckToken
{
    public function __construct(
        protected TemporaryUserService $userService,
    ) {}
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');
        if (!$token) {
            return redirect()->route('register.form');
        }
        $link = $this->userService->findActiveLinkByToken($token);
        if (!$link) {
            return redirect()->route('register.form');
        }
        return $next($request);
    }
}
