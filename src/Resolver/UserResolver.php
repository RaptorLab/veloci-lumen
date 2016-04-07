<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 02:51
 */

namespace Veloci\Lumen\Resolver;


use Illuminate\Http\Request;
use Veloci\User\Exception\ValidationException;
use Veloci\User\User;

interface UserResolver
{
    /**
     * @param Request $request
     * @return User
     *
     * @throws ValidationException
     */
    public function resolve(Request $request):User;

    public static function getType():string;
}