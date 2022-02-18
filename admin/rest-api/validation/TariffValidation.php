<?php

include_once 'CheckUserPermission.php';

class TariffValidation
{
    use CheckUserPermission;

    private function validation_get()
    {
        return [
            'methods'  => 'GET',
            'callback' => null,
            'permission_callback' => [$this, 'check_user_access'],
            'args'     => [],
        ];
    }

    private function validation_post()
    {
        return [
            'methods'  => 'POST',
            'callback' => null,
            'permission_callback' => [$this, 'check_user_access'],
            'args'     => [],
        ];
    }

    public function get_validation()
    {
        return [
            $this->validation_get(),
            $this->validation_post()
        ];
    }
}