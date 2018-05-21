<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 5/18/2018
 * Time: 12:43 PM
 */

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public $response;

    public $message;

    public function __construct($response, $code = 404)
    {
        $this->response = $response;
        $this->message = $response;
        $this->code = $code;
    }


    public function getResponse()
    {
        return $this->response;
    }

    public function getMessages()
    {
        return $this->message;
    }
}