<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 9/3/2019
 * Time: 1:25 PM
 */

namespace App\Exceptions;

use RuntimeException;

class ApiValidationException extends RuntimeException
{
    public $original;
    protected $message, $errors, $status;

    public function __construct($message, $errors, $status)
    {
        $this->message = $message;
        $this->errors = $errors;
        $this->status = $status;
        $this->original = ['message' => $message, 'errors' => $errors];
    }

    public function report()
    {
        return ['message' => $this->message, 'errors' => $this->errors, 'status' => $this->status];
    }

    public function render()
    {
        return response()->json([
            'message' => $this->message,
            'errors' => $this->errors], $this->status);
    }

    public function getStatusCode()
    {
        return $this->status;
    }

}
