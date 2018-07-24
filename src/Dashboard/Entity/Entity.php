<?php
declare(strict_types=1);

namespace Dashboard\Entity;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;

class Entity
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
     * @return Entity
     */
    public function setId(int $id): Entity
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
     * @return Entity
     */
    public function setName(string $name): Entity
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
     * @return Entity
     */
    public function setBody(string $body): Entity
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
     * @return Entity
     */
    public function setUserId(int $user_id): Entity
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
     * @return Entity
     */
    public function setCreated(?DateTimeInterface $created): Entity
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
     * @return Entity
     */
    public function setModified(?DateTimeInterface $modified): Entity
    {
        if ($modified instanceof DateTimeImmutable) {
            $this->modified = new DateTime($modified->format(DateTime::ATOM));
        } elseif ($modified == null) {
            $this->modified = new DateTime();
        }
        return $this;
    }

}