<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponserTrait;


class NotFoundMessage extends Exception
{

    use ApiResponserTrait;
    protected $resource;

    public function __construct($resource = "resource", $code = 404, Exception $previous = null)
    {
        $this->resource = $resource;
        $message = "The {$resource} you are trying to view was not found!";
        parent::__construct($message, $code, $previous);
    }

    public function render($request){
        return $this->errorResponse($this->getMessage(), $this->getCode());
    }
}
