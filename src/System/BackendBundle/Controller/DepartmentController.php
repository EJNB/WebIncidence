<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use System\BackendBundle\Form\DepartmentType;

/**
 * Department controller.
 *
 */
class DepartmentController extends Controller
{
    /**
     * Lists all department entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $department = new Department();
        $form = $this->createForm(DepartmentType::class,$department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($department);
            $em->flush();

            $this->addFlash(
                'notice',
                'Sus cambios han sido guardados satisfactoriamente'
            );

            return $this->redirectToRoute('department_index');
        }

        $departments = $em->getRepository('SystemBackendBundle:Department')->findAll();

        return $this->render('department/index.html.twig', array(
            'departments' => $departments,
            'form' => $form->createView()
        ));
    }

//    /**
//     * Creates a new department entity.
//     *
//     */
//    public function newAction(Request $request)
//    {
//        $department = new Department();
//        $form = $this->createForm('System\BackendBundle\Form\DepartmentType', $department);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($department);
//            $em->flush();
//
//            return $this->redirectToRoute('department_index');
//        }
//
//        return $this->render('department/new.html.twig', array(
//            'department' => $department,
//            'form' => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a department entity.
//     *
//     */
//    public function showAction(Department $department)
//    {
////        $deleteForm = $this->createDeleteForm($department);
//
//        return $this->render('department/show.html.twig', array(
//            'department' => $department,
////            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing department entity.
     *
     */
    public function editAction(Request $request, Department $department)
    {
//        $deleteForm = $this->createDeleteForm($department);
        $editForm = $this->createForm('System\BackendBundle\Form\DepartmentType', $department);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Sus cambios han sido editados satisfactoriamente'
            );

            return $this->redirectToRoute('department_index');
        }

        return $this->render('department/edit.html.twig', array(
            'department' => $department,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a department entity.
     *
     */
    public function deleteAction(Request $request, Department $department)
    {
//        $form = $this->createDeleteForm($department);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($department);
        $em->flush();
        $this->addFlash(
            'notice',
            'Su registro ha sido eliminado satisfactoriamente'
        );
//        }

        return $this->redirectToRoute('department_index');
    }
}
