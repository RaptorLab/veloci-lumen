<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 12/03/16
 * Time: 16:25
 */

namespace Veloci\Lumen\Controller\User;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Lumen\Resolver\StandardUserResolver;
use Veloci\User\Manager\AuthManager;
use Veloci\User\Manager\UserManager;
use Veloci\User\Repository\UserRepository;
use Veloci\User\User;

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

    public function __construct(UserManager $userManager, UserRepository $userRepository)
    {
        $this->userManager    = $userManager;
        $this->userRepository = $userRepository;
    }

    public function get(Request $request, $id)
    {
        return response('To implement', 418);
    }


    public function getAll()
    {
        $users = $this->userRepository->getAll(null, false);

        return response()->json($users->toArray());
    }

    public function update()
    {
//        return response(json_encode($result));
    }

    public function save(Request $request)
    {



        $model = $this->userRepository->save($model);

        return response(json_encode($this->modelSerializer->serialize($model)));
    }

    public function delete($id)
    {

    }
}

