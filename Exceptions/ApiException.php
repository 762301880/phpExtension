<?php


namespace App\Exceptions;


use Exception;
use Throwable;

class ApiException extends Exception
{
    /**
     * 请求时异常
     * ApiException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
