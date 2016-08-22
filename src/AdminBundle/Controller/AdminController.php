<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function showAction($id)
    {
        $admin = $this->getDoctrine()->getRepository('AdminBundle:Admin')->find($id);

        if (!$admin) {
            throw $this->createNotFoundException('No admins found by id: ' . $id);
        }

        return $this->render('AdminBundle:Admins:show.html.twig', ['user' => $admin]);
    }
}