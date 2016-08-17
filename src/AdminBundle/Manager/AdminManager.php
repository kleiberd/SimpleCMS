<?php

namespace AdminBundle\Manager;

use AdminBundle\Entity\AdminRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class AdminManager implements AdminManagerInterface
{
    protected $repository;

    protected $addUsername;

    public function __construct(EntityManager $entityManager, $class, $addUsername)
    {
        $repository = $entityManager->getRepository($class);

        if (!$repository instanceof AdminRepository) {
            throw new UnsupportedUserException(sprintf('Expected an instance of AdminBundle\Entity\AdminRepository, but got "%s', get_class($repository)));
        }

        $this->repository = $repository;
        $this->addUsername = $addUsername;
    }

    public function findUserByUsernameOrEmail($username)
    {
        return $this->repository->findUserByUsernameOrEmail($username);
    }

    public function findUserById($id)
    {
        return $this->repository->find($id);
    }

    public function getUserClass()
    {
        return $this->repository->getClassName();
    }

    public function supportsClass($class)
    {
        $userClass = $this->getUserClass();

        return $userClass === $class || is_subclass_of($class, $userClass);
    }

    public function getAddUsername()
    {
        return $this->addUsername;
    }

    public function getRepository()
    {
        return $this->repository;
    }
}