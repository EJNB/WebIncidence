<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\Incidence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Incidence controller.
 *
 */
class IncidenceController extends Controller
{
    /**
     * Lists all incidence entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $incidences = $em->getRepository('SystemBackendBundle:Incidence')->findAll();

        return $this->render('incidence/index.html.twig', array(
            'incidences' => $incidences,
        ));
    }

    /**
     * Creates a new incidence entity.
     *
     */
    public function newAction(Request $request)
    {
        $incidence = new Incidence();
        $form = $this->createForm('System\BackendBundle\Form\IncidenceType', $incidence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($incidence);
            $em->flush();

            return $this->redirectToRoute('incidence_show', array('id' => $incidence->getId()));
        }

        return $this->render('incidence/new.html.twig', array(
            'incidence' => $incidence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a incidence entity.
     *
     */
    public function showAction(Incidence $incidence)
    {
        $deleteForm = $this->createDeleteForm($incidence);

        return $this->render('incidence/show.html.twig', array(
            'incidence' => $incidence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing incidence entity.
     *
     */
    public function editAction(Request $request, Incidence $incidence)
    {
        $deleteForm = $this->createDeleteForm($incidence);
        $editForm = $this->createForm('System\BackendBundle\Form\IncidenceType', $incidence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('incidence_edit', array('id' => $incidence->getId()));
        }

        return $this->render('incidence/edit.html.twig', array(
            'incidence' => $incidence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a incidence entity.
     *
     */
    public function deleteAction(Request $request, Incidence $incidence)
    {
        $form = $this->createDeleteForm($incidence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($incidence);
            $em->flush();
        }

        return $this->redirectToRoute('incidence_index');
    }

    /**
     * Creates a form to delete a incidence entity.
     *
     * @param Incidence $incidence The incidence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Incidence $incidence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('incidence_delete', array('id' => $incidence->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
