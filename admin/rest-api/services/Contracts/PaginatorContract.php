<?php
 
interface PaginatorContract
{
    const DEFAULT_COUNT_ITEMS_IN_PAGE = 15;

    public function set_entity($entity);
}