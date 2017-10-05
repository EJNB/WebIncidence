<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use System\BackendBundle\Form\ServiceTypeType;

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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serviceType = new Servicetype();
        $form = $this->createForm(ServiceTypeType::class,$serviceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serviceType);
            $em->flush();

            $this->addFlash(
                'notice',
                'Sus cambios han sido guardados satisfactoriamente'
            );

            return $this->redirectToRoute('servicetype_index');
        }

        $serviceTypes = $em->getRepository('SystemBackendBundle:ServiceType')->findAll();

        return $this->render('servicetype/index.html.twig', array(
            'serviceTypes' => $serviceTypes,
            'form' => $form->createView(),
        ));
    }

//    /**
//     * Creates a new serviceType entity.
//     *
//     */
//    public function newAction(Request $request)
//    {
//        $serviceType = new Servicetype();
//        $form = $this->createForm('System\BackendBundle\Form\ServiceTypeType', $serviceType);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($serviceType);
//            $em->flush();
//
//            return $this->redirectToRoute('servicetype_index');
//        }
//
//        return $this->render('servicetype/new.html.twig', array(
//            'serviceType' => $serviceType,
//            'form' => $form->createView(),
//        ));
//    }

//    /**
//     * Finds and displays a serviceType entity.
//     *
//     */
//    public function showAction(ServiceType $serviceType)
//    {
//        $deleteForm = $this->createDeleteForm($serviceType);
//
//        return $this->render('servicetype/show.html.twig', array(
//            'serviceType' => $serviceType,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing serviceType entity.
     *
     */
    public function editAction(Request $request, ServiceType $serviceType)
    {
//        $deleteForm = $this->createDeleteForm($serviceType);
        $editForm = $this->createForm('System\BackendBundle\Form\ServiceTypeType', $serviceType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Sus cambios han sido guardados satisfactoriamente'
            );

            return $this->redirectToRoute('servicetype_index');
        }

        return $this->render('servicetype/edit.html.twig', array(
            'serviceType' => $serviceType,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a serviceType entity.
     *
     */
    public function deleteAction(Request $request, ServiceType $serviceType)
    {
//        $form = $this->createDeleteForm($serviceType);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($serviceType);
        $em->flush();
        $this->addFlash(
            'notice',
            'Su tipo de servicio ha sido eliminado satisfactoriamente'
        );
//        }

        return $this->redirectToRoute('servicetype_index');
    }
}
