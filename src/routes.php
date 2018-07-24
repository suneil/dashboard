<?php
declare(strict_types=1);

$app->group('/entity', function () {
    $this->post('', \Dashboard\Controllers\EntityController::class . ':create');
    $this->get('/{id}', \Dashboard\Controllers\EntityController::class . ":entity");
});

$app->get('/', \Dashboard\Controllers\Home::class . ":index");
