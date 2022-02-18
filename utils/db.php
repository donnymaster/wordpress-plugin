<?php

class DB {

    const TARIFF_TABLE_NAME = 'dm_tariffs';

    private $db = null;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;   
    }

    public function run() {
        $this->create_table(self::TARIFF_TABLE_NAME);
    }

    private function create_table($table) {
        if (!$this->exists_table([$table])) {
            $this->db->query($this->get_query_create_table($table));
        }
    }

    private function exists_table($table = '') {
        $result = $this->db->get_var($this->db->prepare('SHOW TABLES LIKE %s', $table));

        return (bool) $result;
    }

    private function get_query_create_table($table) {
        $requests_create_tables = [
            self::TARIFF_TABLE_NAME => '
            CREATE TABLE ' . self::TARIFF_TABLE_NAME. '
            (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                created_at DATETIME NULL,
                updated_at DATETIME NULL,
                price_private_sector SMALLINT UNSIGNED NULL,
                price_apartments_sector SMALLINT UNSIGNED NULL,
                unique_fields TEXT NULL,
                template_name VARCHAR(255) NOT NULL
            );
            '
        ];

        return $requests_create_tables[$table];
    }
}