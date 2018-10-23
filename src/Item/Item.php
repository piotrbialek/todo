<?php


namespace ToDo\Item;


class Item implements ItemInterface
{
    private $id;
    private $name;
    private $completed;
    private $deadline;

//    public function __construct($name, $deadline)
//    {
//        $this->name = $name;
//        $this->deadline = $deadline;
//    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDeadline(): string
    {
        return $this->deadline;
    }

    public function setDeadline(string $deadline)
    {
        $this->deadline = $deadline;
    }

    public function getCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed)
    {
        $this->completed = $completed;
    }
}
