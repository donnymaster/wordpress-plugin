<?php

include_once realpath(dirname(__FILE__) . '/Contracts/PaginatorContract.php');

class Paginator implements PaginatorContract
{
    private $entity = '';

    private $page = 1;

    private $order_by = [];

    private $search = null;

    private $builder = null;

    public function set_entity($entity)
    {
        if (!$entity) {
            throw new Exception('Paginator didn\'t get entity');
        }

        $this->entity = $entity;

        return $this;
    }

    public function set_order_by($order_by)
    {
        $this->order_by = $order_by ? $order_by : [];

        return $this;
    }

    public function set_search($search = null)
    {
        $this->search = $search;

        return $this;
    }

    

    public function set_page($page = null)
    {
        $this->page = $page ? $page : self::DEFAULT_COUNT_ITEMS_IN_PAGE;

        return $this;
    }

    public function get_entity()
    {
        // build sql request

        /**
         * pipeline sql 
         * -> from(database) 
         * -> join(connect other database) 
         * -> where(filter data) 
         * -> group by(data aggregation) 
         * -> havving(filter data) 
         * -> select(returns final data) 
         * -> order by(final sort data)
         */
        return [];
    }


}