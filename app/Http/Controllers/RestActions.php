<?php

namespace App\Http\Controllers;

trait RestActions
{

    public function respond($status, $data = [], $message = null, $error = null)
	{
		return response()->json([
            'status' => $status,
            'result' => $data,
            'message'=>$message,
            'error' => $error
        ], 200);
    }

    /**
     * Take message from Throwable error.
     *
     * @param  th  $th
     * @return \Illuminate\Http\Response
     */
    public function respondServerError($errorMessage)
    {
        return response()->json([
            'status' => 500,
            'message' => 'Internal Server Error',
            'error' => $errorMessage
        ], 500);
    }
}
