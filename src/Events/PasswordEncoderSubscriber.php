<?php

namespace App\Events;

use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class PasswordEncoderSubscriber implements EventSubscriberInterface
{
 
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    //on implémente la fonction de l'interface EventSubscriberInterface
    public static function getSubscribedEvents()
    {
        return [
            //1 - Je me connecte à l'évènement view du Kernel
            //2- Je lui indique la fonction à exécuter (fonction de hashage du password)
            // 3 - Je lui indique à quelle de la vie de la requete il doit lancer le code (avant l'écriture en BDD)
            KernelEvents::VIEW =>['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }
    public function hashPassword( ViewEvent $event): void{
        $user = $event->getControllerResult(); // on utilise la métthode du notre évènement pour récuperer une instance de USER
        $method = $event->getRequest()->getMethod(); //on récupére la méthode de la requette
        
        //on opère une vérification pour que le code s'effectue seulement s'il s'agit d'une instance de USER et d'une requête en méthode POST
        if ($user instanceof User && $method === "POST"){
            $hash = $this->encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($hash);
        }
    }
}