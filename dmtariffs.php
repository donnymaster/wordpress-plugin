<?php
/*
Plugin Name: Plugin for tariffs from Donny Master
Description: Plugin for tariffs
Author: Donny Master
*/

include_once plugin_dir_path( __FILE__ ) . 'utils/db.php';

include_once plugin_dir_path( __FILE__ ) . 'admin/rest-api/dm-rest-api.php';

register_activation_hook(__FILE__, 'init_plugin');

function init_plugin() {
    (new DB())->run();
}

// add menu link
add_action('admin_menu', 'admin_menu_link');

function admin_menu_link() {
    add_menu_page("Тарифы", "Тарифы", "manage_options", "dmtariffs", "page_list_tariffs", "dashicons-text-page");
}

function page_list_tariffs() {
    include_once plugin_dir_path( __FILE__ ) . 'admin/tariffs_list.php';
}

(new DM_RESTAPI())->run();
