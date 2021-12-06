<?php
namespace App\Events;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;


class JwtCreatedSubscriber{

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event):void
    {
        $user = $event->getUser(); // on récupère les données de notre utilisateurs
    
        if(!$user instanceof UserInterface){
            return;
        }

        $payload = $event->getData(); // on récupére les données du token

        $payload['id'] = $user->getId();
        $payload['gender'] = $user->getGender();
        $payload['firstname'] = $user->getFirstname();
        $payload['surname'] = $user->getSurname();
        $payload['isNotified'] = $user->getIsNotified();    
    
        $event->setData($payload); // on enrichit notre token avec les informations de l'utilisateur
    }
}



