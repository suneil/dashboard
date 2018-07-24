<?php
declare(strict_types=1);

namespace Dashboard\Items;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;

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
        $this->id = null;
        $this->setCreated(null);
        $this->setModified(null);
        $this->setUserId(0);
        $this->setName('');
    }

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @param DateTimeInterface $created
     * @return Item
     */
    public function setCreated(?DateTimeInterface $created): Item
    {
        if ($created instanceof DateTimeImmutable) {
            $this->created = new DateTime($created->format(DateTime::ATOM));
        } elseif ($created == null) {
            $this->created = new DateTime();
        }
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
     * @param DateTimeInterface|null $modified
     * @return Item
     */
    public function setModified(?DateTimeInterface $modified): Item
    {
        if ($modified instanceof DateTimeImmutable) {
            $this->modified = new DateTime($modified->format(DateTime::ATOM));
        } elseif ($modified == null) {
            $this->modified = new DateTime();
        }
        return $this;
    }

}