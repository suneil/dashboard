<?php
declare(strict_types=1);

namespace Dashboard\Items;

use Dashboard\Items\Service;
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
                'db' => function ($c) {
                    $db = new \Aura\Sql\ExtendedPdo(
                        'mysql:host=127.0.0.1;port=3306;dbname=dashboard',
                        // 'mysql:dbname=dashboard',
                        'root',
                        '',
                        [
                            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                        ]
                    );
                    $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

                    return $db;
                },
            ],
        ]);

        $this->container = $container;
    }

    /**
     * Yeah, this depends on database for now. Needs to change to use fixtures
     */
    public function testGetItem()
    {
        $db = $this->container->get('db');
        $logger = $this->container->get('logger');
        // $service = new Service($db, $logger);

        $service = $this->getMockBuilder(Service::class)
            ->setConstructorArgs([$db, $logger])
            ->setMethods(['getAllItems']) // Lame
            ->getMock();

        /** @var Item $item */
        $item = $service->getItem(1); // should use fixtures

        $this->assertEquals($item->getName(), 'Test');
        $this->assertNotEquals($item->getUserId(), 2);
    }
}
