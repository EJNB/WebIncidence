<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\SubCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subcategory controller.
 *
 */
class SubCategoryController extends Controller
{
    /**
     * Lists all subCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subCategories = $em->getRepository('SystemBackendBundle:SubCategory')->findAll();

        return $this->render('subcategory/index.html.twig', array(
            'subCategories' => $subCategories,
        ));
    }

    /**
     * Creates a new subCategory entity.
     *
     */
    public function newAction(Request $request)
    {
        $subCategory = new Subcategory();
        $form = $this->createForm('System\BackendBundle\Form\SubCategoryType', $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subCategory);
            $em->flush();

            return $this->redirectToRoute('subcategory_index', array('id' => $subCategory->getId()));
        }

        return $this->render('subcategory/new.html.twig', array(
            'subCategory' => $subCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subCategory entity.
     *
     */
    public function showAction(SubCategory $subCategory)
    {
        $deleteForm = $this->createDeleteForm($subCategory);

        return $this->render('subcategory/show.html.twig', array(
            'subCategory' => $subCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subCategory entity.
     *
     */
    public function editAction(Request $request, SubCategory $subCategory)
    {
        $editForm = $this->createForm('System\BackendBundle\Form\SubCategoryType', $subCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subcategory_index', array('id' => $subCategory->getId()));
        }

        return $this->render('subcategory/edit.html.twig', array(
            'subCategory' => $subCategory,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a subCategory entity.
     *
     */
    public function deleteAction(Request $request, SubCategory $subCategory)
    {
//        $form = $this->createDeleteForm($subCategory);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subCategory);
            $em->flush();
//        }

        return $this->redirectToRoute('subcategory_index');
    }
}
