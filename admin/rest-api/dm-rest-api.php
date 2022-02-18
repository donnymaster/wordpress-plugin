<?php

include_once 'routes.php';

class DM_RESTAPI
{
    const RESTAPI_PATH = 'api/v1/dm_tariffs/';

    private $routes = [];

    public function __construct()
    {
        $this->routes = (new RESTAPI_ROUTES())->get_routes();
    }

    public function run()
    {
        add_action('rest_api_init', [$this, 'init']);
    }

    public function init()
    {
        foreach ($this->routes as $path => $config) {
            register_rest_route(
                self::RESTAPI_PATH,
                $path,
                $config
            );
        }

    }
}