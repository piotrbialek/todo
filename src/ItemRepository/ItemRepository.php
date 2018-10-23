<?php

namespace ToDo\ItemRepository;

use ToDo\Db\ItemTableInterface;
use ToDo\Item\Item;
use ToDo\Item\ItemInterface;

class ItemRepository implements ItemRepositoryInterface
{
    private $table;

    public function __construct(ItemTableInterface $itemTable)
    {
        $this->table = $itemTable;
    }

    public function save(ItemInterface $item)
    {
        return $this->table->insert($item->getName(), $item->getDeadline());
    }

    public function edit(ItemInterface $item)
    {
        return $this->table->editItem($item->getId(), $item->getName(), $item->getDeadline());
    }

    public function markCompleted(ItemInterface $item)
    {
        $item->setCompleted(true);
        return $this->table->updateItemCompleted($item->getId(), $item->getCompleted());
    }

    public function getById($id)
    {
//        $this->table->fetchId($id);

        return $this->table->fetchId($id);
    }

    public function findAll()
    {
        return $this->table->findAllNotCompletedItems();
    }

    public function findAllSort($sort)
    {
        return $this->table->sortAllItems($sort);
    }

}