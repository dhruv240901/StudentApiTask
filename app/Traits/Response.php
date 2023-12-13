<?php

namespace App\Traits;

trait Response
{
    // function to display success message
    public function success($status, $message, $data=null)
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
            return $this->error('Invalid success code!', 400);
        }
    }

    // function to display error message
    public function error($status, $message,$data=null)
    {
        $errorMessages = [
            400 => 'Bad Request!',
            403 => 'Unauthorized!',
            404 => 'Not Found!',
        ];

        if (array_key_exists($status, $errorMessages)) {
            $response = [
                'status'  => $status,
                'message' => $message != "" ? $message : $errorMessages[$status],
                'data'    => $data,
            ];
            return response()->json($response);
        } else {
            return $this->error('Invalid error code!', 500);
        }
    }

}
