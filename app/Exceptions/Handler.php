<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        //
    }
    /*
        public function render($request, Exception $e)
        {
            if ($e instanceof \Illuminate\Session\TokenMismatchException) {

                return redirect('/login');

            }
            return parent::render($request, $e);
        }
    */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'status'    => false,
            "msg"       => __('unauthorized')
        ], 403);
    }

}
