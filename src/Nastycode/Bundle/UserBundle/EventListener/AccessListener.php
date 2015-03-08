<?php

namespace Nastycode\Bundle\UserBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;

class AccessListener
{
    public function onKernelRequest(GetResponseEvent $event){
        if ($event->isMasterRequest()) {
            $loginRoute = 'fos_user_security_login';

            $request = $event->getRequest();

            // Return if current route and login route match
            if ($request->get('_route') === $loginRoute) {
                return;
            }

            if( $this->security->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
                $url = $this->router->generate($loginRoute);
                $event->setResponse(new RedirectResponse($url));
            }
        }
    }
}