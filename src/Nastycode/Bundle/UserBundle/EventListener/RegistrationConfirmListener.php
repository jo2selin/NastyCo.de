<?php

namespace Nastycode\Bundle\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationConfirmListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => array('onRegistrationConfirm',-10),
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => array('onRegistrationConfirm',-10), 
            FOSUserEvents::PROFILE_EDIT_SUCCESS => array('onRegistrationConfirm',-10),                        
        );
    }

    public function onRegistrationConfirm(FormEvent $event)
    {
        $url = $this->router->generate('nastycode_front_home_index');

        $event->setResponse(new RedirectResponse($url));
    }
}