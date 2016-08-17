<?php

namespace AdminBundle\Security\User;

use AdminBundle\Entity\Admin;
use AdminBundle\Manager\AdminManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    protected $adminManager;

    public function __construct(AdminManagerInterface $adminManager)
    {
        $this->adminManager = $adminManager;
    }

    public function loadUserByUsername($username)
    {
        $admin = $this->adminManager->findUserByUsernameOrEmail($username);

        if (!$admin) {
            throw new UsernameNotFoundException(sprintf('Username or Email "%s" does not exist.', $username));
        }

        return $admin;
    }

    public function refreshUser(UserInterface $admin)
    {
        if (!$admin instanceof Admin) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($admin)));
        }

        $refreshedAdmin = $this->adminManager->findUserById($admin->getId());
        if (null === $refreshedAdmin) {
            throw new UsernameNotFoundException(sprintf('User with ID "%d" could not refreshed', $admin->getId()));
        }

        return $refreshedAdmin;
    }

    public function supportsClass($class)
    {
        return $this->adminManager->supportsClass($class);
    }
}