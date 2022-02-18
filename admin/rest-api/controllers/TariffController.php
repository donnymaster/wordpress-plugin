<?php

include_once  'Contract/ControllerContract.php';
include_once realpath(dirname(__FILE__) . '/../services/response/ResponseContract.php');
include_once realpath(dirname(__FILE__) . '/../services/TariffService.php');
include_once realpath(dirname(__FILE__) . '/../validation/TariffValidation.php');
include_once realpath(dirname(__FILE__) . '/../validation/CheckUserPermission.php');

class TariffController implements ControllerContract
{
    use CheckUserPermission;

    public $root_path = 'tariffs/';

    private $sender = null;

    private $validation = null;

    private $tariff_service = null;

    public function __construct(ResponseContract $sender)
    {
        $this->sender = $sender;
        $this->validation = new TariffValidation;
        $this->tariff_service = new TariffService();
    }

    public function index(WP_REST_Request $request)
    {
        var_dump($_GET);
        die;
        
        $tariff_id = $request->get_param('id');

        if($tariff_id) {
            if(!$tariff = $this->tariff_service->get_tariff_by_id($tariff_id)) {
                return $this->sender->error('not found tariff!', WP_Http::NOT_FOUND); // TODO: localization string
            }
            
            return $this->sender->success($tariff, WP_Http::OK);
        }

        $tariffs = $this->tariff_service->get_tariffs($request);

        return $this->sender->success($tariffs, WP_Http::OK);
    }

    public function create()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }

    public function create_routes()
    {
        return [
            $this->root_path => [
                [
                    'methods' => 'GET',
                    'callback' => [$this, 'index'],
                    'args' => [
                        'id' => [
                            'type' => 'numeric',
                            'required' => false,
                            'validate_callback' => function($value) { return is_numeric($value); }
                        ]
                    ]
                ],
                [
                    'methods' => 'POST',
                    'callback' => [$this, 'create'],
                ],
                [
                    'methods' => 'PUT',
                    'callback' => [$this, 'update'],
                ],
                [
                    'methods' => 'DELETE',
                    'callback' => [$this, 'destroy'],
                ]
            ]
        ];
    }
}
