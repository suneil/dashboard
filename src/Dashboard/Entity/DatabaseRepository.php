<?php
declare(strict_types=1);

namespace Dashboard\Entity;

use Aura\Sql\ExtendedPdo;
use Psr\Log\LoggerInterface;

/**
 * Class DatabaseRepository
 *
 * Wraps database access
 *
 * @package Dashboard\EntityController
 */
class DatabaseRepository implements RepositoryInterface
{
    /** @var ExtendedPdo  */
    protected $db;

    /** @var LoggerInterface */
    protected $logger;

    public function __construct(ExtendedPdo $db, LoggerInterface $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getAllItems(): array
    {
        $query = "SELECT * FROM item";

        $results = $this->db->fetchAll($query);

        return $results;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getItem(int $id): array
    {
        $this->logger->debug("Getting item from database: $id");

        $query = "SELECT * FROM item WHERE id = ?";

        $result = $this->db->fetchOne($query, [$id]);

        return $result;
    }
}