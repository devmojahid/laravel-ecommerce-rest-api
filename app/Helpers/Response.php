<?php 

function responseData($data = null, $message = null, $status = 200)
{
    $response = [
        'data' => $data,
        'message' => $message,
        'status' => $status,
    ];
    return response()->json($response, $status);
}