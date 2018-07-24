<?php
declare(strict_types=1);

namespace Dashboard\Entity;

use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Datastore\Query\Query;
use Psr\Log\LoggerInterface;

class DataStoreRepository implements RepositoryInterface
{
    /** @var LoggerInterface */
    protected $logger;

    /** @var DatastoreClient */
    protected $client;

    protected $kind = 'Entity';

    public function __construct(DatastoreClient $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getAllItems(): array
    {
        $limit = 100;
        $cursor = null;

        $query = $this->client->query()
            ->kind($this->kind)
            // ->order('created', Query::ORDER_DESCENDING)
            ->limit($limit)
            ->start($cursor);

        $results = $this->client->runQuery($query);
        $books = [];
        $nextPageCursor = null;

        foreach ($results as $entity) {
            $book = $entity->get();
            $book['id'] = $entity->key()->pathEndIdentifier();
            $books[] = $book;
            $nextPageCursor = $entity->cursor();
        }

        // return [
        //     'books' => $books,
        //     'cursor' => $nextPageCursor,
        // ];

        return $books;
    }

    public function getItem(int $id): array
    {
        $key = $this->client->key($this->kind, $id);
        $entity = $this->client->lookup($key);

        if ($entity) {
            $book = $entity->get();
            $book['id'] = $id;
            return $book;
        }
        return false;
    }

    public function create(array $book, $key = null): ?int
    {
        // $this->verifyBook($book);
        $key = $this->client->key($this->kind);
        $entity = $this->client->entity($key, $book);
        $this->client->insert($entity);
        // return the ID of the created datastore entity
        $id = $entity->key()->pathEndIdentifier();
        $id = is_numeric($id) ? intval($id) : $id;
        return $id;
    }

}