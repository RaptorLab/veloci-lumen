<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 03:03
 */

namespace Veloci\Lumen\Resolver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Veloci\User\Exception\ValidationException;
use Veloci\User\Repository\UserRepository;
use Veloci\User\User;

class StandardUserResolver implements UserResolver
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var \Illuminate\Validation\Validator
     */
    private $validator;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return User
     *
     * @throws ValidationException
     */
    public function resolve(Request $request):User
    {
        $this->check($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->get('username');
        $password = $request->get('password');

        //
        $user = $this->userRepository->getUserByUsername($username);

        if ($user === null) {
            throw new ValidationException([
                'username' => 'not exists'
            ]);
        }

        if ($user->getPassword() !== $password) {
            throw new ValidationException([
                'password' => 'wrong'
            ]);
        }

        return $user;
    }

    public static function getType():string
    {
        return 'standard';
    }

    private function check(Request $request, $rules)
    {
        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator->getMessageBag()->toArray());
        }
    }
}