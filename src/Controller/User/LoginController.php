<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/04/16
 * Time: 15:58
 */

namespace Veloci\Lumen\Controller\User;


use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Veloci\Lumen\Factory\UserResolverFactory;
use Veloci\Lumen\Resolver\StandardUserResolver;
use Veloci\User\Manager\AuthManager;

class LoginController extends Controller
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

    public function handle(Request $request)
    {
        $userResolver = $this->userResolverFactory->getUserResolver(StandardUserResolver::getType());

        $user = $userResolver->resolve($request);
        
        if ($user === null) {
            abort(401);
        }

        $session = $this->authManager->login($user);

        return response()->json([
            'token'=> (string)$session->getToken()
        ]);
    }
}