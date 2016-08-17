<?php

namespace AdminBundle\Manager;

interface AdminManagerInterface
{

    public function findUserByUsernameOrEmail($username);

    public function findUserById($id);

    public function supportsClass($class);

}