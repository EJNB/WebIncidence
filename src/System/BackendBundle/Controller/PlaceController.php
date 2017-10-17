<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use System\BackendBundle\Form\PlaceType;

/**
 * Place controller.
 *
 */
class PlaceController extends Controller
{
    /**
     * Lists all place entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $place = new Place();
        $form = $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

        $places = $em->getRepository('SystemBackendBundle:Place')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();

            $this->addFlash(
                'notice',
                'Sus cambios ha sido guardados satisfactoriamente'
            );

            return $this->redirectToRoute('place_index');
        }

        return $this->render('place/index.html.twig', array(
            'places' => $places,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing place entity.
     *
     */
    public function editAction(Request $request, Place $place)
    {
        $editForm = $this->createForm('System\BackendBundle\Form\PlaceType', $place);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Sus cambios ha sido guardados satisfactoriamente'
            );

            return $this->redirectToRoute('place_index');
        }

        return $this->render('place/edit.html.twig', array(
            'place' => $place,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a place entity.
     *
     */
    public function deleteAction(Place $place)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($place);
        $em->flush();
        $this->addFlash(
            'notice',
            'Su registro ha sido elimnado satisfactoriamente'
        );

        return $this->redirectToRoute('place_index');
    }
}
