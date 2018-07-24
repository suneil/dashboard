<?php
declare(strict_types=1);

namespace Dashboard\Controllers;

use Psr\Container\ContainerInterface;
use Slim\CallableResolverAwareTrait;
use Slim\Http\Response;
use Slim\Views\Twig;

abstract class AbstractController
{
    use CallableResolverAwareTrait;

    /** @var Twig */
    protected $view;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
    }

    /**
     * @param Response $response
     * @param string $view
     * @param array $data
     * @return Response
     */
    public function render(Response $response, string $view, array $data = []): Response
    {
        return $this->view->render($response, $view, $data);
    }
}