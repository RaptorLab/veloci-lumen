<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 12/03/16
 * Time: 16:25
 */

namespace Veloci\Lumen\Controller;

use App\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\User\Manager\AuthManager;
use Veloci\User\Manager\UserManager;
use Veloci\User\Repository\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ModelSerializer
     */
    private $modelSerializer;
    /**
     * @var AuthManager
     */
    private $authManager;

    public function __construct(UserManager $userManager, AuthManager $authManager, UserRepository $userRepository)
    {
        $this->userManager    = $userManager;
        $this->userRepository = $userRepository;
        $this->authManager    = $authManager;
    }

    public function signup(Request $request)
    {

        $data = $request->all();

        /** @var User $user */
        $user = $this->userManager->create($data);

        $this->userManager->signup($user);

        $response = $this->userRepository->serialize($user);

        return response()->json($response);
    }


    

    public function logout()
    {
    }

    public function get(Request $request, $id)
    {

    }


    public function getAll()
    {
        $users = $this->userRepository->getAll();

        $result = [];

        foreach ($users as $key => $user) {
            $result[] = (array)$user;
        }

    }

    public function update()
    {
//        return response(json_encode($result));
    }

    public function save(Request $request)
    {
        $model = $this->userManager->create($request->input());
        $model = $this->userRepository->save($model);

        return response(json_encode($this->modelSerializer->serialize($model)));
    }

    public function delete($id)
    {

    }
}

