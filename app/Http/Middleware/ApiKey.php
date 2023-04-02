<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiKey
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
            $key = $request->get('token');
            if (empty($key)) throw new \Exception('API key is not provided.', JsonResponse::HTTP_FORBIDDEN);

            if ($key !== config('api.key')) {
                throw new \Exception('Invalid API key provided.', JsonResponse::HTTP_FORBIDDEN);
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
