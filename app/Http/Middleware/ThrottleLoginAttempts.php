<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Cache\RateLimiter;

class ThrottleLoginAttempts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     protected $limiter;

     public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->limiter->tooManyAttempts($this->throttleKey($request), 3, 30)){
            return response()->json(['message' => 'Too many login attempts. Try again after 30 seconds.'], 429);
        }

        $response = $next($request);

        if ($response->getStatusCode() === 401){
            $this->limiter->hit($this->throttleKey($request), 30);
        }

        return $response;
    }

    protected function throttleKey(Request $request){
        return $request->input('email'). '|' . $request->ip();
    }
}
