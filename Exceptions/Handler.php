<?php

namespace App\Api\Exceptions;

use App;
use Exception;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * To output error response, this app needs to throw an exception (preferably ApiException.)
     * The exception will be converted to JSON output, with defined HTTP status code (Default 400).
     * If it is not production env, debug stack trace will added to JSON output too.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $response = response()->json();
        $responseData = [
            'err_code' => 0,
            'err_msg' => '',
            'err_data' => [],
            'timestamp' => date('c'),
        ];
        
        if ($exception instanceof ApiException)
        {
            $response->setStatusCode(400);
            $responseData['err_data'] = $exception->getErrors();
        }
        else if ($exception instanceof HttpException)
        {
            $response->setStatusCode($exception->getStatusCode());
        }
        else
        {
            $response->setStatusCode(500);
        }
        
        $responseData['err_code'] = $exception->getCode();
        
        $responseData['err_msg'] = $exception->getMessage();
        if ($responseData['err_msg'] == '')
        {
            $responseData['err_msg'] = get_class($exception);
        }

        if (!app()->environment('production'))
        {
            $responseData['debug'] = [];
            foreach ($exception->getTrace() as $trace)
            {
                $index = count($responseData['debug']);

                $responseData['debug'][$index] = [
                    'function' => ($trace['class'] ?? '')
                        .($trace['type'] ?? '')
                        .$trace['function'],
                ];

                if (isset($trace['file']))
                {
                    $responseData['debug'][$index]['file'] = $trace['file'].':'.$trace['line'];
                }
            }
        }

        $response->setData($responseData);
        return $response;
    }
}
