<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 02:48
 */

namespace Veloci\Lumen\Controller;


use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Veloci\User\Factory\UserResolverFactory;
use Veloci\User\Manager\AuthManager;
use Veloci\User\Resolver\StandardUserResolver;

class AuthController extends Controller
{
    /**
     * @var UserResolverFactory
     */
    private $userResolverFactory;
    
    /**
     * @var AuthManager
     */
    private $authManager;

    public function __construct(AuthManager $authManager, UserResolverFactory $userResolverFactory)
    {
        $this->userResolverFactory = $userResolverFactory;
        $this->authManager         = $authManager;
    }

    public function login(Request $request)
    {
        $userResolver = $this->userResolverFactory->getUserResolver(StandardUserResolver::getType());

        $user = $userResolver->resolve($request);


        if ($user === null) {
            abort(401);
        }

        $session = $this->authManager->login($user);

        return response()->json([
            'token'=> $session->getId()
        ]);
    }
}