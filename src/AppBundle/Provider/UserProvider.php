<?php

namespace AppBundle\Provider;

use FOS\UserBundle\Security\UserProvider as BaseUserProvide;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class UserProvider extends BaseUserProvide
{
    public function loadUserByUsername($email)
    {
        $user = $this->userManager->findUserByEmail($email);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $email));
        }

        return $user;
    }
}