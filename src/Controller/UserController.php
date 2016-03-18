<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 12/03/16
 * Time: 16:25
 */

namespace Veloci\Lumen\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Veloci\Core\Helper\Resultset\Filter\ClosureResultsetFilter;
use Veloci\Core\Helper\Serializer\ModelSerializer;
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

    public function signup()
    {

    }

    public function login()
    {
        $result = ['Result' => 'CIao'];

        return response(json_encode($result), 200);
    }

    public function get(Request $request, $id)
    {

    }

    public function getAll(Request $request)
    {
        $users = $this->userRepository->getAll();

        $result = [];

        foreach ($users as $key => $user) {
            $result[] = (array)$user;
        }

        return response(json_encode($result));
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
}

