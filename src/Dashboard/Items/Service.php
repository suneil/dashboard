<?php
declare(strict_types=1);

namespace Dashboard\Items;

use Aura\Sql\ExtendedPdo;
use Psr\Log\LoggerInterface;
use Zend\Hydrator\ClassMethods as Hydrator;

/**
 * Class Service
 *
 * Abstraction for working with items. Uses repositories as
 * the actual service to work with data
 *
 * @package Dashboard\Items
 */
class Service
{
    /** @var LoggerInterface  */
    protected $logger;

    /** @var ExtendedPdo  */
    protected $db;

    /** @var DatabaseRepository */
    protected $repository;

    public function __construct(RepositoryInterface $repository, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getAllItems(): array
    {
        $this->logger->debug("Getting all items");

        $items = [];

        $results = $this->repository->getAllItems();

        if (empty($results)) {
            return $items;
        }

        $hydrator = new Hydrator(false, true);

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

        $data = $this->repository->getItem($id);

        $hydrator = new Hydrator();

        $item = $hydrator->hydrate($data, $item);

        return $item;
    }

    public function create(Item $item)
    {
        $hydrator = new Hydrator(true, true);
        $data = $hydrator->extract($item);

        $this->repository->create($data);
    }
}