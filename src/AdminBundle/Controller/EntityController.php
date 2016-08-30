<?php

namespace AdminBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EntityController extends Controller
{
    public function indexAction($name)
    {
        $configs = $this->getParameter('admin.entities');

        if (!isset($configs[$name])) {
            throw new EntityNotFoundException;
        }

        $entityName = $configs[$name]['entity'];

        /*$datatable = $this->get('admin.datatable.entity');
        $datatable->setEntity($entityName);
        $datatable->setName($name);
        $datatable->buildDatatable();

        return $this->render('AdminBundle:Entity:index.html.twig', [
            'datatable' => $datatable
        ]);*/

        $elements = $this->getDoctrine()->getRepository($entityName)->findAll();

        return $this->render('AdminBundle:Entity:index.html.twig', [
            'name' => $name,
            'elements' => $elements,
            'columns' => $configs[$name]['columns'],
            'actions' => $configs[$name]['actions']
        ]);
    }

    public function indexResultsAction($name)
    {
        $configs = $this->getParameter('admin.entities');

        if (!isset($configs[$name])) {
            throw new EntityNotFoundException;
        }

        $entityName = $configs[$name];

        $datatable = $this->get('admin.datatable.entity');
        $datatable->setEntity($entityName);
        $datatable->setName($name);
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    public function editAction($name, $id, Request $request)
    {
        $configs = $this->getParameter('admin.entities');

        if (!isset($configs[$name])) {
            throw new EntityNotFoundException;
        }

        $entityName = $configs[$name]['entity'];

        $element = $this->getDoctrine()->getRepository($entityName)->find($id);

        if (!$element) {
            throw $this->createNotFoundException('No element found for id ' . $id);
        }

    }

    public function deleteAction($name, $id)
    {

    }
}