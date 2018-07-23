<?php
declare(strict_types=1);

namespace Dashboard\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\CallableResolverAwareTrait;
use Slim\Views\Twig;

abstract class AbstractController
{
    use CallableResolverAwareTrait;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /** @var Twig */
    protected $view;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->view;
    }

    /**
     * @param ResponseInterface $response
     * @param string $view
     * @param array $data
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, string $view, array $data = []): ResponseInterface
    {
        return $this->view->render($response, $view, $data);
    }
}