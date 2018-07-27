<?php
declare(strict_types=1);

namespace Dashboard\Controllers;

use Dashboard\User\DataStoreRepository;
use Dashboard\User\User;
use Dashboard\User\Service;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Hydrator\ClassMethods;

/**
 * Class UserController
 * @package Dashboard\Controllers
 */
class UserController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function user(Request $request, Response $response, array $args): Response
    {
        // $repo = new DatabaseRepository($this->container->db, $this->container->logger);
        $repo = new DataStoreRepository($this->container->datastore, $this->container->logger);
        $service = new Service($repo, $this->container->logger);

        $itemId = intval($args['id']);

        $item = $service->getItem($itemId);

        return $this->render($response, 'user.twig', [
            'item' => $item,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function new(Request $request, Response $response, array $args): Response
    {
        return $this->render($response, 'user/new.twig');
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
            $service = new Service($repo, $this->container->logger);

            $item = new User();
            $hydrator = new ClassMethods(true, true);
            $hydrator->hydrate($params, $item);

            $service->create($item);
        } catch (\Exception $e) {
            echo $e;
        }

        return $response;
    }
}

