<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    /**
     * Cette méthode est appelée juste avant la création du token.
     * de cette manière, je peux ajouter des informations supplémentaires au token.
     */
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();
        $user    = $event->getUser();

        // --- J'informe intelisense que $user est de type AppUser ---
        /** @var \App\Entity\AppUser $user */

        $payload['id'] = $user->getId();
        $payload["username"] = $user->getName();
        $payload['email']    = $user->getUserIdentifier();
        $payload['roles'] = $user->getRoles();
 
        $event->setData($payload);
    }
}