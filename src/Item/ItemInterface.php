<?php


namespace ToDo\Item;


interface ItemInterface
{
    public function getId();

    public function setId(int $id);

    public function getName(): string;

    public function setName(string $name);

    public function getDeadline(): string;

    public function setDeadline(string $deadline);

    public function getCompleted(): bool;

    public function setCompleted(bool $completed);


}