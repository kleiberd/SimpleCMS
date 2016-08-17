<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AdminRepository extends EntityRepository
{
    public function findUserByUsernameOrEmail($username)
    {
        return $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}