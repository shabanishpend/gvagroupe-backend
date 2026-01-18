<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key');
        $expectedApiKey = config('app.api_key');

        // Check if API key is configured on the server
        if (empty($expectedApiKey)) {
            return response()->json([
                'message' => 'API key is not configured on the server',
                'error' => 'Server Configuration Error'
            ], 500);
        }

        // Check if API key is provided
        if (!$apiKey) {
            return response()->json([
                'message' => 'API key is required',
                'error' => 'Unauthorized'
            ], 401);
        }

        // Check if API key matches
        if ($apiKey !== $expectedApiKey) {
            return response()->json([
                'message' => 'Invalid API key',
                'error' => 'Unauthorized'
            ], 401);
        }

        // Optional: Validate Origin/Referer for additional security
        $allowedOrigins = config('app.allowed_origins', []);
        $origin = $request->header('Origin') ?? $request->header('Referer');
        
        if (!empty($allowedOrigins) && $origin) {
            $originHost = parse_url($origin, PHP_URL_HOST);
            $isAllowed = false;
            
            foreach ($allowedOrigins as $allowedOrigin) {
                $allowedHost = parse_url($allowedOrigin, PHP_URL_HOST);
                if ($originHost === $allowedHost) {
                    $isAllowed = true;
                    break;
                }
            }
            
            if (!$isAllowed) {
                return response()->json([
                    'message' => 'Origin not allowed',
                    'error' => 'Forbidden'
                ], 403);
            }
        }

        return $next($request);
    }
}

