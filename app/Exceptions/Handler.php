<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $model = app($exception->getModel());
            return response()->json([
                'message' => method_exists($model, 'notFoundMessage') ? 'Источник не найден!' : 'Ресурс не найден!',
            ], 404);
        }
        return parent::render($request, $exception);
    }

    public function unauthenticated($request, AuthenticationException $exception) 
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Необходимо авторизоваться!'], 401);
        }
        return redirect()->guest('login');
    }
}
