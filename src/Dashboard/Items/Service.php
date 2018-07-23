<?php
declare(strict_types=1);

namespace Dashboard\Items;

use Aura\Sql\ExtendedPdo;
use Psr\Log\LoggerInterface;
use Zend\Hydrator\ClassMethods as Hydrator;

/**
 * Class Service
 * @package Dashboard\Items
 */
class Service
{
    /** @var LoggerInterface  */
    protected $logger;

    /** @var ExtendedPdo  */
    protected $db;

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
        $this->logger->debug("Getting all items");

        $items = [];

        $query = "SELECT * FROM item";

        $results = $this->db->fetchAll($query);

        if (empty($results)) {
            return $items;
        }
        $hydrator = new Hydrator();

        foreach ($results as $result) {
            $items[] = $hydrator->hydrate($result, new Item());
        }

        return $items;
    }

    /**
     * @param int $id
     * @return Item|null
     */
    public function getItem(int $id): ?Item
    {
        $this->logger->debug("Getting item: $id");

        $item = new Item();

        $query = "SELECT * FROM item WHERE id = ?";

        $result = $this->db->fetchOne($query, [$id]);

        $hydrator = new Hydrator();

        $item = $hydrator->hydrate($result, $item);

        return $item;
    }
}