<?php
declare(strict_types=1);

namespace Dashboard\Controllers;

use Dashboard\Entity\DatabaseRepository;
use Dashboard\Entity\DataStoreRepository;
use Dashboard\Entity\Entity;
use Dashboard\Entity\Service;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Hydrator\ClassMethods;

/**
 * Class EntityController
 * @package Dashboard\Controllers
 */
class EntityController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function entity(Request $request, Response $response, array $args): Response
    {
        // $repo = new DatabaseRepository($this->container->db, $this->container->logger);
        $repo = new DataStoreRepository($this->container->datastore, $this->container->logger);
        $itemService = new Service($repo, $this->container->logger);

        $itemId = intval($args['id']);

        $item = $itemService->getItem($itemId);

        return $this->render($response, 'entity.twig', [
            'item' => $item,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function create(Request $request, Response $response, array $args): Response
    {
        try {
            $params = $request->getParams();
            $repo = new DataStoreRepository($this->container->datastore, $this->container->logger);
            $itemService = new Service($repo, $this->container->logger);

            $item = new Entity();
            $hydrator = new ClassMethods(true, true);
            $hydrator->hydrate($params, $item);

            $itemService->create($item);
        } catch (\Exception $e) {
            echo $e;
        }

        return $response;
    }
}

