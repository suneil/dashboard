<?php
declare(strict_types=1);

namespace Dashboard\Entity;

use Google\Cloud\Datastore\DatastoreClient;
use PHPUnit\Framework\TestCase;
use RKA\ZsmSlimContainer\Container;

class ServiceTest extends TestCase
{
    public $container;

    public function setup()
    {
        $container = new Container([
            'factories' => [
                'logger' => function ($c) {
                    $logger = new \Monolog\Logger('phpunit');
                    $logger->pushHandler(new \Monolog\Handler\TestHandler());
                    return $logger;
                },
                // Yeah, this ain't smart but for now...
                'datastore' => function ($c) {
                    return $this->getMockBuilder(DatastoreClient::class)->disableOriginalConstructor()->getMock();
                },
            ],
        ]);

        $this->container = $container;
    }

    /**
     * Need to mock database
     */
    public function testGetItem()
    {
        $datastore = $this->container->get('datastore');
        $logger = $this->container->get('logger');

        $repo = $this->getMockBuilder(DataStoreRepository::class)
            ->setConstructorArgs([$datastore, $logger])
            ->getMock();

        $repo->method('getItem')
            ->will($this->returnValue([
                'id' => 1,
                'name' => 'Test',
                'user_id' => 1,
                'body' => 'Fixture'
            ]));

        $service = new Service($repo, $logger);
        $item = $service->getItem(1);

        $this->assertEquals($item->getName(), 'Test');
        $this->assertNotEquals($item->getUserId(), 2);
    }
}
