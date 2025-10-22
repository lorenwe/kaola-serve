<?php

namespace App\Exceptions\Api;

use Exception;

class UploadHandler extends Exception
{
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }


    public function render()
    {
        return response()->json([
            'code' => $this->code,
            'message' => $this->message,
        ], $this->code);
    }
}
