<?php
declare(strict_types=1);

namespace Dashboard\Items;

use DateTime;

class Item
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $body;

    /** @var int */
    public $user_id;

    /** @var DateTime */
    public $created;

    /** @var DateTime */
    public $modified;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Item
     */
    public function setId(int $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Item
     */
    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Item
     */
    public function setBody(string $body): Item
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return Item
     */
    public function setUserId(int $user_id): Item
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param string $created
     * @return Item
     */
    public function setCreated(string $created): Item
    {
        $this->created = date_create($created);
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getModified(): DateTime
    {
        return $this->modified;
    }

    /**
     * @param string $modified
     * @return Item
     */
    public function setModified(string $modified): Item
    {
        $this->modified = date_create($modified);
        return $this;
    }


}