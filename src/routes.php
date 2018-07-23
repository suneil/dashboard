<?php
declare(strict_types=1);

$app->get('/', \Dashboard\Controllers\Home::class . ":index");
$app->get('/item/{id}', \Dashboard\Controllers\Items::class . ":item");
