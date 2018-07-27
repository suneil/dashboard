<?php
declare(strict_types=1);

namespace Dashboard\Middleware;

use Google\Cloud\Datastore\DatastoreClient;
use RKA\ZsmSlimContainer\Container;

class DataStoreAuth
{
    /** @var Container */
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __invoke(array $arguments): bool
    {
        $user = $arguments["user"];
        $password = $arguments["password"];

        if ($user === null) {
            return false;
        }

        /** @var DatastoreClient $client */
        $client = $this->container->get('datastore');

        $query = $client->query()->kind('User')->filter('username', '=', $user);
        $results = $client->runQuery($query);

        $entity = $results->current();

        if ($entity) {
            $user = $entity->get();
            return password_verify($password, $user['password']);
        }

        return true;
    }
}