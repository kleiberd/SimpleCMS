<?php

namespace AdminBundle\DataFixtures\ORM;

use AdminBundle\Entity\Admin;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadAdminData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $adminUser = new Admin();
        $adminUser->setEmail("admin@admin.com");
        $adminUser->setUsername("admin");
        $password = $this->container->get('security.password_encoder')->encodePassword($adminUser, "admin");
        $adminUser->setPassword($password);
        $adminUser->setFirstname('David');
        $adminUser->setLastname('Kleiber');

        $manager->persist($adminUser);
        $manager->flush();
    }
}