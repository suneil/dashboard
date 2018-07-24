<?php
declare(strict_types=1);

namespace Dashboard\Middleware;

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

        $client = $this->container->get('datastore');
        $key = $client->key('Auth', $user);
        $entity = $client->lookup($key);

        if ($entity) {
            $user = $entity->get();
            return password_verify($password, $user['password']);
        }

        return false;
    }
}