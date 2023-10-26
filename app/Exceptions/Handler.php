<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // Custimized 404 page
    public function render($request, Throwable $exception)
        {
            if ($this->isHttpException($exception) && $exception->getStatusCode() == 404) {
                return response()->view('errors.404', [], 404);
            }
            if ($this->isHttpException($exception) && $exception->getStatusCode() == 503) {
                return response()->view('errors.503', [], 503);
            }

            return parent::render($request, $exception);
        }

}
