<?php
/**
 * Created by PhpStorm.
 * User: piotr.bialek
 * Date: 16.08.2018
 * Time: 12:50
 */

namespace ToDo\Db;


interface ItemTableInterface
{
    public function insert($name, $deadline);

    public function fetch($id);

    public function fetchId($id);

    public function findAllNotCompletedItems();

    public function updateItemCompleted($id, $completed);

    public function editItem($id, $name, $deadline);

    public function sortAllItems($completed);

    public function sortAllItemsD($completed);

    public function findAllItems();

}