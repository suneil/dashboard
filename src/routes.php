<?php
declare(strict_types=1);

$app->group('/entity', function () {
    $class = \Dashboard\Controllers\EntityController::class;
    $this->post('', "{$class}:create");
    $this->get('/new', "{$class}:new");
    $this->get('/{id}', "{$class}:entity");
});

$app->group('/user', function () {
    $class = \Dashboard\Controllers\UserController::class;
    $this->post('',  "{$class}:create");
    // $this->get('/new', "{$class}:new");
    $this->get('/{id}', "{$class}:entity");
});

$app->get('/', \Dashboard\Controllers\Home::class . ":index");
