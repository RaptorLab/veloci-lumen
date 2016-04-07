<?php

// $app->get ...

/**
 * @api {get} users Get all users
 * @apiName GetAllUsers
 * @apiGroup User
 */
$this->app->get('api/users', [
    'as'   => 'user.get',
    'uses' => \Veloci\Lumen\Controller\UserController::class . '@getAll'
]);


/**
 * @api {post} users/signup Signup user
 * @apiName SignupUser
 * @apiGroup User
 */
$this->app->post('api/users/signup', [
    'as'   => 'user.signup',
    'uses' => \Veloci\Lumen\Controller\UserController::class . '@signup'
]);

/**
 * @api {post} users/login Login user
 * @apiName LoginUser
 * @apiGroup User
 */
$this->app->post('api/users/login', [
    'as'   => 'user.login',
    'uses' => \Veloci\Lumen\Controller\AuthController::class . '@login'
]);


/**
 * @api {post} users/logout Logout user
 * @apiName LogoutUser
 * @apiGroup User
 */
$this->app->post('api/users/logout', function () {
    return response('To implement', 418);
});


/**
 * @api {get} users/:id Get a user
 * @apiName GetUser
 * @apiGroup User
 */

$this->app->get('api/users/{id}', function () {
    return response('To implement', 418);
});

/**
 * @api {put} users/:id Update a user
 * @apiName UpdateUser
 * @apiGroup User
 */
$this->app->put('api/users', function () {
    return response('To implement', 418);
});

/**
 * @api {delete} users/$id Delete a user
 * @apiName DeleteUser
 * @apiGroup User
 */
$this->app->delete('api/users', function () {
    return response('To implement', 418);
});
