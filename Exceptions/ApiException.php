<?php

namespace App\Api\Exceptions;

use Exception;
use \Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Subclass of ApiException must be thown to render error API response.
 * Subclass *MUST* define error code by hardcoding `$code` class attribute.
 */
class ApiException extends Exception
{

    /**
     * @var int All subclass *MUST* define an error code.
     * Remember to define the error codes in README.md.
     */
    protected $code = 400;

    /** @var array Optional custom error data, will be converted to JSON output. */
    protected $errors = [];

    public function __construct(string $message = "", $errors = [])
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    /**
     * @param array $data Custom error data
     */
    public function setErrors($data)
    {
        $this->errors = $data;
    }

    /**
     * @return array Custom error data.
     */
    public function getErrors()
    {
        return $this->errors;
    }

}