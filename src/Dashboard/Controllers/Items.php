<?php
declare(strict_types=1);

namespace Dashboard\Controllers;

use Dashboard\Items\DatabaseRepository;
use Dashboard\Items\Service;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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
    public function item(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $repo = new DatabaseRepository($this->container->db, $this->container->logger);
        $itemService = new Service($repo, $this->container->logger);

        $itemId = intval($args['id']);

        $item = $itemService->getItem($itemId);

        return $this->render($response, 'item.twig', [
            'item' => $item,
        ]);
    }
}

