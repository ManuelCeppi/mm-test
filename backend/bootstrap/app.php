<?php

use App\Http\Middleware\FormatResponseMiddleware;
use App\Http\Middleware\InternalUserMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // Api registering
            Route::middleware('api')
                ->prefix('api')
                ->name('api.')
                ->group(base_path('routes/api.php'));

            // Auth apis
            Route::middleware('api')
                ->prefix('auth')
                ->name('auth.')
                ->group(base_path('routes/auth.php'));

            // Internal apis
            Route::middleware('api')
                ->prefix('internal')
                ->name('internal.')
                ->group(base_path('routes/internal.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(FormatResponseMiddleware::class);
        $middleware->alias([
            'internal_user_middleware' => InternalUserMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Basic exception management
        $exceptions->renderable(function (BadRequestException $e) {
            return response()->json([
                'error' => 'bad_request',
                'error_ex' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'message' => $e->getMessage(),
                ],
                'result' => []
            ], 400);
        });

        $exceptions->renderable(function (AuthenticationException $e) {
            return response()->json([
                'error' => 'not_authenticated',
                'error_ex' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'message' => $e->getMessage(),
                ],
                'result' => []
            ], 401);
        });

        $exceptions->renderable(function (UnauthorizedException $e) {
            return response()->json([
                'error' => 'unauthorized',
                'error_ex' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'message' => $e->getMessage(),
                ],
                'result' => []
            ], 403);
        });

        // Resource not found
        $exceptions->renderable(function (NotFoundResourceException $e) {
            return response()->json([
                'error' => 'resource_not_found',
                'error_ex' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'message' => $e->getMessage(),
                ],
                'result' => []
            ], 404);
        });

        // Model not found exception
        $exceptions->renderable(function (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'resource_not_found',
                'error_ex' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'message' => $e->getMessage(),
                ],
                'result' => []
            ], 404);
        });

        // Route not found
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'error' => 'route_not_found',
                'error_ex' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'message' => $e->getMessage(),
                ],
                'result' => []
            ], 404);
        });

        // Error not handled
        $exceptions->renderable(function (Throwable $e) {
            return response()->json([
                'error' => 'error_not_handled',
                'error_ex' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'message' => $e->getMessage(),
                    'trace' => $e->getTrace()
                ],
                'result' => []
            ], 522);
        });
    })->create();
