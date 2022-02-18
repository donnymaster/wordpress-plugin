<?php

include_once 'controllers/TariffController.php';

include_once realpath(dirname(__FILE__) . '/services/response/Response.php');

class RESTAPI_ROUTES
{
    private $routes = [];

    private $sender = null;

    public function __construct()
    {
        $this->sender = new Response;

        $this->routes = array_merge(
            (new TariffController($this->sender))->create_routes()
        );
    }

    public function get_routes()
    {
        return $this->routes;
    }
}