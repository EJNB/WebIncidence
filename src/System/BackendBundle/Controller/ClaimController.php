<?php

namespace System\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use System\BackendBundle\Entity\Claim;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Claim controller.
 *
 */
class ClaimController extends Controller
{
    /**
     * Lists all claim entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $claims = $em->getRepository('SystemBackendBundle:Claim')->findAll();

        return $this->render('claim/index.html.twig', array(
            'claims' => $claims,
        ));
    }

    /**
     * Creates a new claim entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $dql = 'SELECT i,b FROM SystemBackendBundle:Incidence i JOIN i.booking b WHERE b.code=:code';
            $query = $em->createQuery($dql)->setParameter('code',$reference);
            $incidences = $query->getResult();
            if($incidences){
                return $this->render(':claim:incidences_by_booking.html.twig', array(
                    'incidences' => $incidences
                ));
            }else{
                return false;
            }
            return new Response('ok');
        }
        $claim = new Claim();
        $form = $this->createForm('System\BackendBundle\Form\ClaimType', $claim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($claim);
            $em->flush();

            return $this->redirectToRoute('claim_show', array('id' => $claim->getId()));
        }

        return $this->render('claim/new.html.twig', array(
            'claim' => $claim,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a claim entity.
     *
     */
    public function showAction(Claim $claim)
    {
        $deleteForm = $this->createDeleteForm($claim);

        return $this->render('claim/show.html.twig', array(
            'claim' => $claim,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing claim entity.
     *
     */
    public function editAction(Request $request, Claim $claim)
    {
        $deleteForm = $this->createDeleteForm($claim);
        $editForm = $this->createForm('System\BackendBundle\Form\ClaimType', $claim);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('claim_edit', array('id' => $claim->getId()));
        }

        return $this->render('claim/edit.html.twig', array(
            'claim' => $claim,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a claim entity.
     *
     */
    public function deleteAction(Request $request, Claim $claim)
    {
        $form = $this->createDeleteForm($claim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($claim);
            $em->flush();
        }

        return $this->redirectToRoute('claim_index');
    }

    /**
     * Creates a form to delete a claim entity.
     *
     * @param Claim $claim The claim entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Claim $claim)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('claim_delete', array('id' => $claim->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
