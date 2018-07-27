<?php
declare(strict_types=1);

namespace Dashboard\User;

use Aura\Sql\ExtendedPdo;
use Psr\Log\LoggerInterface;
use Zend\Hydrator\ClassMethods as Hydrator;

/**
 * Class Service
 * @package Dashboard\User
 */
class Service
{
    /** @var LoggerInterface  */
    protected $logger;

    /** @var ExtendedPdo  */
    protected $db;

    /** @var RepositoryInterface */
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
            $items[] = $hydrator->hydrate($result, new User());
        }

        return $items;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getItem(int $id): ?User
    {
        $this->logger->debug("Getting item: $id");

        $item = new User();

        $data = $this->repository->getItem($id);

        $hydrator = new Hydrator();

        $item = $hydrator->hydrate($data, $item);

        return $item;
    }

    public function create(User $item)
    {
        $hydrator = new Hydrator(true, true);
        $data = $hydrator->extract($item);

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $this->repository->create($data);
    }
}