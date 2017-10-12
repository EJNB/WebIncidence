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
        $em = $this->getDoctrine()->getManager();
        $types = $em->getRepository('SystemBackendBundle:IncidenceType')->findAll();
        $form = $this->createForm('System\BackendBundle\Form\IncidenceType', $incidence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($incidence);
            $em->flush();

            return $this->redirectToRoute('incidence_show', array('id' => $incidence->getId()));
        }

        return $this->render('incidence/new.html.twig', array(
            'incidence' => $incidence,
            'form' => $form->createView(),
            'types' => $types,
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

    public function getAjaxBookingDetailAction(Request $request){

        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $tp_service = $this->get('TPService');
            $detail_booking = $tp_service->getBookingGeneralData($reference);
            return $this->render(':incidence:booking_detail.html.twig',array(
                'booking_detail' => $detail_booking,
            ));
        }else{
            return false;
        }
    }

    public function getAjaxServicesDescriptionAction(Request $request){


        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $tp_service = $this->get('TPService');
            $services_description = $tp_service->getBookingServiceDescription($reference);

            return $this->render(':incidence:services_description.html.twig',array(
                'services_description' => $services_description,
            ));
        }else{
            return false;
        }
    }

    public function getAjaxServicesDescriptionActionBySupplierAction(Request $request){


        if($request->isXmlHttpRequest()){
            $supplier = $request->request->get('supplier');
            $tp_service = $this->get('TPService');
            $services_description = $tp_service->findTPBookingServicesDescriptionBySupplier($supplier);

            return $this->render(':incidence:services_description.html.twig',array(
                'services_description' => $services_description,
            ));
        }else{
            return false;
        }
    }

    public function getAjaxBookingSuppliersAction(Request $request){


        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $tp_service = $this->get('TPService');
            $suppliers = $tp_service->getBookingSupplier($reference);

            return $this->render(':incidence:booking_suppliers.html.twig',array(
                'suppliers' => $suppliers,
            ));
        }else{
            return false;
        }
    }

    public function getAjaxServicesBySuppliersAction(Request $request){

        if($request->isXmlHttpRequest()){
            $supplier = $request->request->get('supplier');
            $reference = $request->request->get('reference');
            $tp_service = $this->get('TPService');
            $services = $tp_service->getBookingServiceDescriptionBySupplier($supplier, $reference);

            return $this->render('incidence/services_description.html.twig',array(
                'services_description' => $services,
            ));
        }else{

            return false;
        }
    }

    public function getAjaxBookingClientNamesAction(Request $request){
        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $tp_service = $this->get('TPService');
            $clients = $tp_service->getBookingClientsName($reference);

            return $this->render(':incidence:booking_clients.html.twig',array(
                'clients' => $clients,
            ));
        }else{
            return false;
        }
    }
}
