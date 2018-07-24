<?php
declare(strict_types=1);

$app->group('/item', function () {
    $this->post('', \Dashboard\Controllers\Items::class . ':create');
    $this->get('/{id}', \Dashboard\Controllers\Items::class . ":item");
});

$app->get('/', \Dashboard\Controllers\Home::class . ":index");
