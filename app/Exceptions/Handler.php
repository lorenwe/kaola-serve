<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Response as FoundationResponse;

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

    //重写render
    public function render($request, Throwable $e)
    {
        if (env('APP_DEBUG')) {
            // return parent::render($request, $e);
        }
        if ($e instanceof NotFoundHttpException)  {
            return response()->json([
                'code' => Foundationresponse::HTTP_NOT_FOUND,
                'message' => __('messages.no_route_found')
            ],Foundationresponse::HTTP_NOT_FOUND);
        }
        //判断如果是MethodNotAllowedHttpException时，返回404错误
        if ($e instanceof MethodNotAllowedHttpException)  {
            return response()->json([
                'code' => Foundationresponse::HTTP_NOT_FOUND,
                'message' => __('messages.no_route_found')
            ],Foundationresponse::HTTP_NOT_FOUND);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'code' => Foundationresponse::HTTP_NOT_FOUND,
                'message' => 'Entry for '.str_replace('App\\', '', $e->getModel()).' not found'
            ],Foundationresponse::HTTP_NOT_FOUND);
        }
        //返回
        return response()->json([
            'code' => Foundationresponse::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('messages.server_error'),
        ], Foundationresponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
