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
use Veloci\Core\Repository\MetadataRepository;
use Veloci\User\Exception\ValidationException;
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

    public function __construct(UserManager $userManager, UserRepository $userRepository, ModelSerializer $modelSerializer)
    {
        $this->userManager     = $userManager;
        $this->userRepository  = $userRepository;
        $this->modelSerializer = $modelSerializer;
    }


    public function signup(Request $request)
    {

        $data = $request->all();

        /** @var User $user */
        $user = $this->userManager->create();
        $user = $this->modelSerializer->hydrate($data, $user);
        $this->userManager->signup($user);

        $response = $this->modelSerializer->serialize($user);

        return response()->json($response);
    }


    public function login()
    {
        $result = ['Result' => 'CIao'];

        return response(json_encode($result), 200);
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

        $data = $request->input();

        $model = $this->userManager->create();

        $model = $this->modelSerializer->hydrate($data, $model);

//        var_dump($this->modelSerializer->serialize($model));
//        die();

        $model = $this->userRepository->save($model);

        return response(json_encode($this->modelSerializer->serialize($model)));
    }

    public function delete($id)
    {

    }
}

