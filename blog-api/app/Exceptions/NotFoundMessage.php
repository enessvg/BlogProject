<?php

namespace App\Exceptions;

use Exception;

class NotFoundMessage extends Exception
{
    protected $resource;

    public function __construct($resource = "resource", $code = 404, Exception $previous = null)
    {
        $this->resource = $resource;
        $message = "The {$resource} you are trying to view was not found!";
        parent::__construct($message, $code, $previous);
    }

    public function render($request){
        return response()->json([
            'status' => false,
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
