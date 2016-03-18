<?php

// $app->get ...

$app->get('/users', [
    'as' => 'getUsers',
    'uses' => \Veloci\Lumen\Controller\UserController::class . '@getAll'
]);