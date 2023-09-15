<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $exception->validator->getMessageBag()
            ], 422);
        }
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'success' => false,
                'message' => "Vous n'êtes pas à effectuer des actions sur ce model ",
                'errors' => $exception->getMessage()
            ], 422);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response([
                'message' => "Url introuvable."
            ], 404);
        }
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response([
                'message' => "Non authentifié"
            ], 401);
        }
        if ($exception instanceof ModelNotFoundException) {
            return response([
                'message' => "Aucune instance du model {$exception->getModel()} ne correspond à l'id fourni "
            ], 404);
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response([
                'message' => "Invalide verbe HTTP"
            ], 405);
        }

        $rendered = parent::render($request, $exception);
        return response([
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine()
        ], $rendered->getStatusCode());
    }
}
