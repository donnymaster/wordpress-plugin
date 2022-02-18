<?php

trait CheckUserPermission
{
    public function check_user_access($permission = 'manage_options')
    {
        return current_user_can($permission);
    }
}