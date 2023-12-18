<?php

// function to display success message
function success($status, $message, $data = [])
{
    $successMessages = [
        200 => 'Success',
        201 => 'Created!',
        204 => 'No Content!',
    ];

    if (array_key_exists($status, $successMessages)) {
        $response = [
            'status'  => $status,
            'message' => $message != "" ? $message : $successMessages[$status],
            'data'    => $data,
        ];
        return response()->json($response);
    } else {
        return error('Invalid success code!', 400);
    }
}

// function to display error message
function error($status, $message, $data = [])
{
    $errorMessages = [
        400 => 'Bad Request!',
        403 => 'Unauthorized!',
        404 => 'Not Found!',
        500 => 'Internal Server Error',
        401 => 'Inactivated'
    ];

    if (array_key_exists($status, $errorMessages)) {
        $response = [
            'status'  => $status,
            'message' => $message != "" ? $message : $errorMessages[$status],
            'data'    => $data,
        ];
        return response()->json($response);
    } else {
        return error('Invalid error code!', 500);
    }
}
