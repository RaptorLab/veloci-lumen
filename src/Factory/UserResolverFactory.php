<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 02:50
 */

namespace Veloci\Lumen\Factory;


use Veloci\User\Resolver\UserResolver;

interface UserResolverFactory
{
    public function getUserResolver(string $type):UserResolver;

    public function registerUserResolver(string $userResolver);
}