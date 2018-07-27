<?php
declare(strict_types=1);

namespace Dashboard\User;

use Google\Cloud\Datastore\DatastoreClient;
use Psr\Log\LoggerInterface;

class DataStoreRepository implements RepositoryInterface
{
    /** @var LoggerInterface */
    protected $logger;

    /** @var DatastoreClient */
    protected $client;

    /** @var string */
    protected $kind = 'User';

    /**
     * DataStoreRepository constructor.
     * @param DatastoreClient $client
     * @param LoggerInterface $logger
     */
    public function __construct(DatastoreClient $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function get(int $id): ?array
    {
        $key = $this->client->key($this->kind, $id);
        $entity = $this->client->lookup($key);

        if ($entity) {
            $user = $entity->get();
            $user['id'] = $id;
            return $user;
        }
        return null;
    }

    /**
     * @param array $obj
     * @param null $key
     * @return int|null
     */
    public function create(array $obj, $key = null): ?int
    {
        $key = $this->client->key($this->kind);
        $entity = $this->client->entity($key, $obj);
        $this->client->insert($entity);

        $id = $entity->key()->pathEndIdentifier();
        $id = is_numeric($id) ? intval($id) : $id;

        return $id;
    }

}