<?php

namespace App\Api\Controllers;

use App\Api\Api;
use App\Api\Exceptions\SampleException;

/**
 * Default controller to serve "/".
 */
class MainController extends ApiController
{

    /**
     *  Display basic API info, to show this app is working.
     */
    public function index()
    {
        return response()->json([
            'version' => Api::version(),
            'env' => app()->environment(),
            'build' => Api::build(),
        ]);
    }

    /**
     * Sample to demo how to generate errors in application.
     */
    public function error()
    {
        // Must define a meaningful error message.
        $errMsg = "Sample exception.";

        // This is optional.
        $errData = [
            "This is to demo how to generate API error.",
            "You can define additional error message here.",
            "err_data can be use for custom error data structure.",
        ];

        // App will stop and display error in JSON format.
        throw new SampleException($errMsg, $errData);
    }

}