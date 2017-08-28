<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Servicetype controller.
 *
 */
class ServiceTypeController extends Controller
{
    /**
     * Lists all serviceType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $serviceTypes = $em->getRepository('SystemBackendBundle:ServiceType')->findAll();

        return $this->render('servicetype/index.html.twig', array(
            'serviceTypes' => $serviceTypes,
        ));
    }

    /**
     * Creates a new serviceType entity.
     *
     */
    public function newAction(Request $request)
    {
        $serviceType = new Servicetype();
        $form = $this->createForm('System\BackendBundle\Form\ServiceTypeType', $serviceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serviceType);
            $em->flush();

            return $this->redirectToRoute('servicetype_show', array('id' => $serviceType->getId()));
        }

        return $this->render('servicetype/new.html.twig', array(
            'serviceType' => $serviceType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a serviceType entity.
     *
     */
    public function showAction(ServiceType $serviceType)
    {
        $deleteForm = $this->createDeleteForm($serviceType);

        return $this->render('servicetype/show.html.twig', array(
            'serviceType' => $serviceType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing serviceType entity.
     *
     */
    public function editAction(Request $request, ServiceType $serviceType)
    {
        $deleteForm = $this->createDeleteForm($serviceType);
        $editForm = $this->createForm('System\BackendBundle\Form\ServiceTypeType', $serviceType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servicetype_edit', array('id' => $serviceType->getId()));
        }

        return $this->render('servicetype/edit.html.twig', array(
            'serviceType' => $serviceType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a serviceType entity.
     *
     */
    public function deleteAction(Request $request, ServiceType $serviceType)
    {
        $form = $this->createDeleteForm($serviceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($serviceType);
            $em->flush();
        }

        return $this->redirectToRoute('servicetype_index');
    }

    /**
     * Creates a form to delete a serviceType entity.
     *
     * @param ServiceType $serviceType The serviceType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ServiceType $serviceType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicetype_delete', array('id' => $serviceType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
