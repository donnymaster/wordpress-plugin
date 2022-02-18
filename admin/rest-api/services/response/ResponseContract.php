<?php

interface ResponseContract
{
    public function error($message, $code = 404, $headers = []);

    public function success($body, $code = 200, $headers = []);
}