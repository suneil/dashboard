<?php
declare(strict_types=1);

namespace Dashboard\Controllers;

use Dashboard\Items\Service;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Home
 * @package Dashboard\Controllers
 */
class Home extends AbstractController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $itemService = new Service($this->container->db, $this->container->logger);

        $items = $itemService->getAllItems();

        return $this->render($response, 'home.twig', [
            'items' => $items
        ]);
    }
}

