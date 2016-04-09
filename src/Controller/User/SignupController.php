<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/04/16
 * Time: 15:01
 */

namespace Veloci\Lumen\Controller\User;


use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Veloci\User\Factory\UserFactory;
use Veloci\User\Manager\UserManager;
use Veloci\User\Repository\UserRepository;
use Veloci\User\User;

class SignupController extends Controller
{
    /**
     * @var UserFactory
     */
    private $factory;

    /**
     * @var UserManager
     */
    private $manager;

    /**
     * SignupController constructor.
     * @param UserManager $manager
     * @param UserFactory $factory
     */
    public function __construct(UserManager $manager, UserFactory $factory)
    {
        $this->factory = $factory;
        $this->manager = $manager;
    }

    public function handle(Request $request)
    {
        $data = $request->all();

        /** @var User $user */
        $user = $this->factory->create($data);

        $this->manager->signup($user);

        return response()->json();
    }
}