<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use MongoDB\Driver\Exception\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        GeneralException::class,
        HttpException::class,
        ModelNotFoundException::class,
        AuthenticationException::class,
        ValidationException::class,
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if ($e instanceof GeneralException) {
            $message = $e->getMessage() ? $e->getMessage() : "未知错误，请联系系统管理员";
            $code = 403;
            return rJson([], $message, $code);
        }

        if ($e instanceof ValidationException) {
            $message = $e->validator->getMessageBag()->getMessages();
            $code = 403;
            return rJson([], $message, $code);
        }

        return parent::render($request, $e);
    }
}
