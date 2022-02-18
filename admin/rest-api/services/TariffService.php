<?php

include 'Paginator.php';

class TariffService
{
    private $db = null;

    private $paginator = null;

    const DB_TARIFF_NAME = 'dm_tariffs';

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->paginator = new Paginator;  
    }
    public function get_tariff_by_id($id = null)
    {
        if (!$id) {
            return false;
        }

        $tariff = $this->db->get_row(
            $this->db->prepare('select  * from dm_tariffs where id = %s', $id)
        );

        return $tariff;
    }

    public function get_tariffs(WP_REST_Request $request)
    {
        $page = $request->get_param('page');
        $order_by = $request->get_param('orderby');
        $search = $request->get_param('search');
        
        return $this
            ->paginator
            ->set_entity('dm_tariffs') // TODO: вынести название таблиц в конфиг
            ->set_page($page)
            ->set_search($search)
            ->set_order_by($order_by)
            ->get_entity();
        /**
         * ?page=1 - страница 
         * 
         * ?per_page=20 - количество элементов на странице
         * 
         * ?orderby[name]=asc&orderby[id]=desc - сортировка по полям
         * 
         * ?search[fields][]=name&search[fields][]=id&search[value]=test
         */
    }
}