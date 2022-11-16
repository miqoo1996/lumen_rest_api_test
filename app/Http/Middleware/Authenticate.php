<?php

namespace App\Http\Middleware;

use App\Contracts\HasJsonResponse;
use App\Traits\JsonResponse;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate implements HasJsonResponse
{
    use JsonResponse;

    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return $this->apiFail(['message' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }
}
