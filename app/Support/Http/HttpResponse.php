<?php

namespace App\Support\Http;

class HttpResponse
{
    public function error(
        string $message = null,
        $errors = null,
        int $httpStatus = 403
    ) {
        if (!$message) {
            $message = "common.unknown_error";
        }
        $response = [
            'status'  => 'error',
            'message' => $message,
        ];
        if ($errors !== null) {
            $response['errors'] = is_array($errors) ? $errors : [$errors];
        }
        return response($response, $httpStatus);
    }

    public function unauthorized(
        string $message = "common.unauthorized_error",
        $httpStatus = 403
    ) {
        $response = [
            'status'  => 'unauthorized',
            'message' => $message,
        ];
        return response($response, $httpStatus);
    }

    public function success(
        string $message = null,
        $data = null,
        int $httpStatus = 200,
        string $title = null,
    ) {
        if (!$message) {
            $message = "common.process_succeed";
        }
        $response = [
            'status'  => 'success',
            'message' => $message,
        ];
        if ($data !== null) {
            $response['data'] = $data;
        }
        if ($title !== null) {
            $response['title'] = $title;
        }
        return response($response, $httpStatus);
    }
}
