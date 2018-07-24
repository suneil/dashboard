<?php
declare(strict_types=1);

namespace Dashboard\Controllers;

use Dashboard\Items\DatabaseRepository;
use Dashboard\Items\DataStoreRepository;
use Dashboard\Items\Item;
use Dashboard\Items\Service;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Hydrator\ClassMethods;

/**
 * Class Items
 * @package Dashboard\Controllers
 */
class Items extends AbstractController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function item(Request $request, Response $response, array $args): Response
    {
        // $repo = new DatabaseRepository($this->container->db, $this->container->logger);
        $repo = new DataStoreRepository($this->container->datastore, $this->container->logger);
        $itemService = new Service($repo, $this->container->logger);

        $itemId = intval($args['id']);

        $item = $itemService->getItem($itemId);

        return $this->render($response, 'item.twig', [
            'item' => $item,
        ]);
    }

    public function create(Request $request, Response $response, array $args): Response
    {
        try {
            $params = $request->getParams();
            $repo = new DataStoreRepository($this->container->datastore, $this->container->logger);
            $itemService = new Service($repo, $this->container->logger);

            $item = new Item();
            $hydrator = new ClassMethods(true, true);
            $hydrator->hydrate($params, $item);

            $itemService->create($item);
        } catch (\Exception $e) {
            echo $e;
        }

        return $response;
    }
}

