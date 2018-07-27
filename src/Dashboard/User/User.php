<?php
declare(strict_types=1);

namespace Dashboard\User;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;

class User
{
    /** @var int */
    public $id;

    /** @var string */
    public $username;

    /** @var string */
    public $password;

    /** @var string */
    public $first_name;

    /** @var string */
    public $last_name;

    /** @var DateTime */
    public $created;

    /** @var DateTime */
    public $modified;

    public function __construct()
    {
        $this->id = null;
        $this->setCreated(null);
        $this->setModified(null);
        $this->setFirstName(null);
        $this->setLastName(null);
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
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
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
     * @return User
     */
    public function setCreated(?DateTimeInterface $created): User
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
     * @return User
     */
    public function setModified(?DateTimeInterface $modified): User
    {
        if ($modified instanceof DateTimeImmutable) {
            $this->modified = new DateTime($modified->format(DateTime::ATOM));
        } elseif ($modified == null) {
            $this->modified = new DateTime();
        }
        return $this;
    }

    /**
     * @param string $first_name
     * @return User
     */
    public function setFirstName(?string $first_name): User
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }
    /**
     * @param string $last_name
     * @return User
     */
    public function setLastName(?string $last_name): User
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

}