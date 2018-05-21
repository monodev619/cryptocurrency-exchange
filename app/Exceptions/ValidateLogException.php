<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 5/18/2018
 * Time: 12:42 PM
 */

namespace App\Exceptions;

use Exception;

class ValidateLogException extends Exception
{
    public $errors;

    public $message;

    public function __construct($errors, $message = 'validation error')
    {
        $this->errors = $errors;
        $this->message = $message;
    }


    public function getErrors()
    {
        return $this->errors;
    }

    public function getMessages()
    {
        return $this->message;
    }
}