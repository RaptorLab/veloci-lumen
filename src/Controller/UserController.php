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

    public function __construct(UserManager $userManager, UserRepository $userRepository)
    {
        $this->userManager    = $userManager;
        $this->userRepository = $userRepository;
    }

    
    public function signup(Request $request)
    {
        $data = $request->all();

        return response(json_encode($data, JSON_PRETTY_PRINT));
    }

    
    public function login()
    {
        $result = ['Result' => 'CIao'];

        return response(json_encode($result), 200);
    }
    
    public function logout()
    {

    }
    
    public function getAll()
    {
        $users = $this->userRepository->getAll();

        return response(json_encode($users));
    }
   
    public function get($id)
    {

    }
    
    public function update()
    {

    }
    
    public function delete($id)
    {

    }


}

