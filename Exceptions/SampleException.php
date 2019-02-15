<?php

namespace App\Api\Exceptions;

class SampleException extends ApiException
{

    /**
     * @var int *MUST* define an application-wide unique error code.
     * Remember to define the error codes in README.md.
     */
    protected $code = 1;

}