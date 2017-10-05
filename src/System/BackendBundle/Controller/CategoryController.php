<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use System\BackendBundle\Form\CategoryType;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->addFlash(
                'notice',
                'Sus cambios han sido guardados satisfactoriamente'
            );

            return $this->redirectToRoute('category_index');
        }

        $categories = $em->getRepository('SystemBackendBundle:Category')->findAll();

        return $this->render('category/index.html.twig', array(
            'categories' => $categories,
            'form' => $form->createView()
        ));
    }

//    /**
//     * Creates a new category entity.
//     *
//     */
//    public function newAction(Request $request)
//    {
//        $category = new Category();
//        $form = $this->createForm('System\BackendBundle\Form\CategoryType', $category);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($category);
//            $em->flush();
//
//            return $this->redirectToRoute('category_index', array('id' => $category->getId()));
//        }
//
//        return $this->render('category/new.html.twig', array(
//            'category' => $category,
//            'form' => $form->createView(),
//        ));
//    }

//    /**
//     * Finds and displays a category entity.
//     *
//     */
//    public function showAction(Category $category)
//    {
//        $deleteForm = $this->createDeleteForm($category);
//
//        return $this->render('category/show.html.twig', array(
//            'category' => $category,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function editAction(Request $request, Category $category)
    {
//        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('System\BackendBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Su categoria ha sido editada satisfactoriamente'
            );
            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     */
    public function deleteAction(Request $request, Category $category)
    {
//        $form = $this->createDeleteForm($category);

//        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();

        $this->addFlash(
            'notice',
            'La categoria ha sido eliminada satisfactoriamente'
        );
//        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm(Category $category)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
}
