<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Model\ChangeProfilePassword;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Dashboard:index.html.twig');
    }

    public function profileAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm('admin_edit_profile', $user);

        $passwordForm = $this->createForm('admin_change_profile_password', new ChangeProfilePassword());

        $form->handleRequest($request);

        $passwordForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Profile saved!');

            return $this->redirect($this->generateUrl('profile'));
        }

        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $user = $this->getUser();
            $newPassword = $passwordForm['newPassword']->getData();

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $newPassword);
            $user->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Password changed!');

            return $this->redirect($this->generateUrl('profile'));
        }

        return $this->render('AdminBundle:Dashboard:profile.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'passwordForm' => $passwordForm->createView()
        ]);
    }

    public function localeAction(Request $request)
    {
        $route = $request->getSession()->get('last_route');

        return $this->redirect($this->generateUrl($route['name'], $route['params']));
    }
}