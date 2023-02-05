<?php

namespace App\Http\Controllers;

trait RestActions
{

    public function respond($status, $data = [], $message = null, $error = null)
	{
		return [
            'status' => $status,
            'result' => $data,
            'message'=>$message,
            'error' => $error
        ];
    }

    public function respondServerError($errorMessage)
    {
        return [
            'status' => 500,
            'message' => 'Internal Server Error',
            'error' => $errorMessage
        ];
    }
}
