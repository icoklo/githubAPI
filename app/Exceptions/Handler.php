<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
    AuthorizationException::class,
    HttpException::class,
    // ModelNotFoundException::class,
    ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($e instanceOf ModelNotFoundException)
        {
            // ako netko slucajno unese krivi id grupe i ulovi se ModelNotFoundException generira se ova greska sa kodom 404 u json formatu
            // abort(404);
            $message = "Taj model ne postoji!";
            $array = array('kod' => 404, 'poruka' => $message);
            return (new Response($array,404))->header('Content-Type', 'application/json');
        }
        else
        {
            return parent::render($request, $e);
        }

    }
}
