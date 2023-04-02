<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (
                auth()->check() &&
                (!auth()->user()->hasRole('customer') || auth()->user()->status !== User::STATUS_ACTIVE)
            ) {
                auth()->user()->currentAccessToken()->delete();

                throw new \Exception('Unauthorized.', JsonResponse::HTTP_FORBIDDEN);
            }
        } catch (\Exception $e) {
            $statusCode = $e->getCode();
            $statusCode = is_int($statusCode) && $statusCode > 99 ? $statusCode : 500;

            return response()->json([
                'success' => $statusCode < 400,
                'message' => $e->getMessage(),
                'data' => [],
            ], $statusCode);
        }

        return $next($request);
    }
}
