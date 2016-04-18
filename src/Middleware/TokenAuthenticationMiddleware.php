<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 12/04/16
 * Time: 15:41
 */

namespace Middleware;

use Closure;
use Illuminate\Http\Request;
use Veloci\User\Repository\UserSessionRepository;
use Veloci\User\UserRole;
use Veloci\User\UserSession;

class TokenAuthenticationMiddleware
{
    /**
     * @var UserSessionRepository
     */
    private $userSessionRepository;

    /**
     * TokenAuthenticationMiddleware constructor.
     * @param UserSessionRepository $userSessionRepository
     */
    public function __construct(UserSessionRepository $userSessionRepository)
    {
        $this->userSessionRepository = $userSessionRepository;
    }

    public function handle(Request $request, Closure $next, string $rolesString)
    {
        $token =  $request->input('token');

        /** @var UserSession $userSession */
        $userSession = $this->userSessionRepository->get($token);

        if ($userSession === null) {
            return abort(401);
        }

        $user = $userSession->getUser();

        $roles = implode(',', $rolesString);
        
        if ($user->getRole)

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}