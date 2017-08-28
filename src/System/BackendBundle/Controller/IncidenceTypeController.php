<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\IncidenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Incidencetype controller.
 *
 */
class IncidenceTypeController extends Controller
{
    /**
     * Lists all incidenceType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $incidenceTypes = $em->getRepository('SystemBackendBundle:IncidenceType')->findAll();

        return $this->render('incidencetype/index.html.twig', array(
            'incidenceTypes' => $incidenceTypes,
        ));
    }

    /**
     * Creates a new incidenceType entity.
     *
     */
    public function newAction(Request $request)
    {
        $incidenceType = new Incidencetype();
        $form = $this->createForm('System\BackendBundle\Form\IncidenceTypeType', $incidenceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($incidenceType);
            $em->flush();

            return $this->redirectToRoute('incidencetype_show', array('id' => $incidenceType->getId()));
        }

        return $this->render('incidencetype/new.html.twig', array(
            'incidenceType' => $incidenceType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a incidenceType entity.
     *
     */
    public function showAction(IncidenceType $incidenceType)
    {
        $deleteForm = $this->createDeleteForm($incidenceType);

        return $this->render('incidencetype/show.html.twig', array(
            'incidenceType' => $incidenceType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing incidenceType entity.
     *
     */
    public function editAction(Request $request, IncidenceType $incidenceType)
    {
        $deleteForm = $this->createDeleteForm($incidenceType);
        $editForm = $this->createForm('System\BackendBundle\Form\IncidenceTypeType', $incidenceType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('incidencetype_edit', array('id' => $incidenceType->getId()));
        }

        return $this->render('incidencetype/edit.html.twig', array(
            'incidenceType' => $incidenceType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a incidenceType entity.
     *
     */
    public function deleteAction(Request $request, IncidenceType $incidenceType)
    {
        $form = $this->createDeleteForm($incidenceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($incidenceType);
            $em->flush();
        }

        return $this->redirectToRoute('incidencetype_index');
    }

    /**
     * Creates a form to delete a incidenceType entity.
     *
     * @param IncidenceType $incidenceType The incidenceType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(IncidenceType $incidenceType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('incidencetype_delete', array('id' => $incidenceType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}