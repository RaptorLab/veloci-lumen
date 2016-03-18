<?php

// $app->get ...

use Veloci\Lumen\Controller\UserController;

$app->get('/users', [
    'as'   => 'user.get_all',
    'uses' => UserController::class . '@getAll'
]);

$app->get('/users/{id}', [
    'as'   => 'user.get',
    'uses' => UserController::class . '@get'
]);

$app->post('/users', [
    'as'   => 'user.save',
    'uses' => UserController::class . '@save'
]);