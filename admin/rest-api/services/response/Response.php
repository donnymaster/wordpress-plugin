<?php

include_once 'ResponseContract.php';

class Response implements ResponseContract
{
    public function error($message, $code = 404, $headers = [])
    {
        $data = [
            'message' => $message,
            'code' => $code,
        ];

        return new WP_REST_Response($data, $code, $headers);
    }

    public function success($body, $code = 200, $headers = [])
    {
        $data = [
            'body' => $body,
            'code' => $code,
        ];

        return new WP_REST_Response($data, $code, $headers);
    }
}