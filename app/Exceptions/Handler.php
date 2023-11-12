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

    // Custimized Error page
    public function render($request, Throwable $exception)
        {
            if ($this->isHttpException($exception) && $exception->getStatusCode() == 404) {
                return response()->view('errors.404', [], 404);
            }
            if ($this->isHttpException($exception) && $exception->getStatusCode() == 403) {
                return response()->view('errors.403', [], 403);
            }
            if ($this->isHttpException($exception) && $exception->getStatusCode() == 503) {
                return response()->view('errors.503', [], 503);
            }
            if ($this->isHttpException($exception) && $exception->getStatusCode() == 408) {
                return response()->view('errors.408', [], 408);
            }
            if ($this->isHttpException($exception) && $exception->getStatusCode() == 500) {
                return response()->view('errors.500', [], 500);
            }

            return parent::render($request, $exception);
        }

}
