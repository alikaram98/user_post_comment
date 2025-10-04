<?php

use App\Http\Middleware\EnsureEmailIsVerifiedApi;
use App\Http\Middleware\ThrottleApiRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            'throttle:api-auth'
        ]);

        $middleware->alias([
            'verified.api' => EnsureEmailIsVerifiedApi::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request): JsonResponse {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'رکوردی یافت نشد'
                ], 404);
            }
        });

        $exceptions->render(function (AccessDeniedHttpException $e, Request $request): JsonResponse {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'شما اجازه دسترسی به این منبع را ندارید'
                ], 403);
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request): JsonResponse {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'شما نمی‌توانید به این منبع دسترسی داشته باشید.',
                ], 401);
            }
        });

        $exceptions->render(function (ThrottleRequestsException $e, Request $request): JsonResponse {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'درخواست های شما بیش از حد مجاز هست.',
                ], 429);
            }
        });
    })
    ->create();
