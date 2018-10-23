<?php
/**
 * Created by PhpStorm.
 * User: piotr.bialek
 * Date: 16.08.2018
 * Time: 12:40
 */

namespace ToDo\ItemRepository;

use ToDo\Item\ItemInterface;


interface ItemRepositoryInterface
{
    public function save(ItemInterface $item);

    public function edit(ItemInterface $item);

    public function markCompleted(ItemInterface $item);

    public function getById($id);

    public function findAll();
}