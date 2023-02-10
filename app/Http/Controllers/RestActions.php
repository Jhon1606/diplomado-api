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

    /**
     * Take message from Throwable error.
     *
     * @param  th  $th
     * @return \Illuminate\Http\Response
     */
    public function respondServerError($errorMessage)
    {
        return [
            'status' => 500,
            'message' => 'Internal Server Error',
            'error' => $errorMessage
        ];
    }
}
