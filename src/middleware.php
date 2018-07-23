<?php
declare(strict_types=1);
/**
 * Application middleware
 *
 * Middleware called in reverse or LIFO order
 * For example, middleware at bottom is called first and
 * then proceeding up the file
 */

use Slim\Http\Request;
use Slim\Http\Response;

//$app->add(new \Slim\Csrf\Guard);

$app->add(function ($req, $res, $next) {

    /** @var float $start */
    $start = microtime(true);

    $return = $next($req, $res);

    /** @var float $end */
    $end = microtime(true);

    $elapsed = intval(($end - $start) * 1000000) / 1000.0;

    $this->logger->info("Execution time: $elapsed ms");

    return $return;
});

// Redirect URLs with trailing slash to non-trailing slash
$app->add(function (Request $request, Response $response, callable $next) {

    $uri = $request->getUri();
    $path = $uri->getPath();

    if ($path != '/' && substr($path, -1) == '/') {
        $uri = $uri->withPath(substr($path, 0, -1));

        return $response->withRedirect((string)$uri, 301);
    }

    return $next($request, $response);
});

