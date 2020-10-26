<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

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

    protected function invalidJson($request, ValidationException $exception)
    {
        $errors = [];

        foreach ($exception->errors() as $key => $value) {
            array_push($errors, [
                'status' => $exception->status,
                'source' => ['pointer' => $key],
                'title' => array_reduce($value, function($carry, $item){
                    return $carry . ' ' . $item;
                })
            ]);
        }

        return response()->json([
            'errors' => $errors,
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], $exception->status);
    }
}
