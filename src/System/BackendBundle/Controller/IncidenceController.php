<?php

namespace System\BackendBundle\Controller;

use System\BackendBundle\Entity\Booking;
use System\BackendBundle\Entity\Client;
use System\BackendBundle\Entity\Incidence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use System\BackendBundle\Entity\Incidence_Person;
use System\BackendBundle\Entity\Person;
use System\BackendBundle\Entity\Service;
use System\BackendBundle\Entity\Supplier;

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
        $tp_service = $this->get('tp_service');

        $types = $em->getRepository('SystemBackendBundle:IncidenceType')->findAll();
        $form = $this->createForm('System\BackendBundle\Form\IncidenceType', $incidence);
        $form->handleRequest($request);
        $persons = $em->getRepository('SystemBackendBundle:Person')->findAll();


        if ($form->isSubmitted() && $form->isValid()) {

            $reference = $request->request->get('select_reference');
            $optid = $request->request->get('service');
            $service = $em->getRepository('SystemBackendBundle:Service')->findOneByTourplanId($optid);
            if(!$service){
                $supplier = new Supplier();
                $service = new Service();

                $data_service = $tp_service->getServiceDescriptionByOPT($optid);
                if($data_service){
                    $supplier->setCode($data_service['SUPCODE']);
                    $supplier->setName($data_service['SUPNAME']);
                    $em->persist($supplier);
                    $em->flush();

                    $service->setName($data_service['SERVICEDESCRIPTION']);
                    $service->setLocation($data_service['LOCATION']);
                    $service->setTourplanCode($data_service['SERVICECODE']);
                    $service->setServiceType($data_service['SERVICETYPE']);
                    $service->setSupplier($supplier);
                    $service->setTourplanId($optid);
                    $em->persist($service);
                    $em->flush();
                }
            }

            $client_name = $request->request->get('clients');
            $booking = $em->getRepository('SystemBackendBundle:Booking')->findOneByCode($reference);
            $count_booking = 1;
            if(!$booking){
                $data_booking = $tp_service->getBookingGeneralData($reference);
                var_dump($reference);
                $booking = new Booking();
                $booking->setName($data_booking['BOOKING_NAME']);
                $booking->setCode($data_booking['FULL_REFERENCE']);
                $booking->setAgent($data_booking['AGENT_NAME']);
                $booking->setConsultant($data_booking['CONSULTANT_NAME']);
//                traveldate
//                $booking->set($data_booking['TRAVELDATE']);

                $em->persist($booking);
                $em->flush();

                $client = new Client();
                $client->setBooking($booking);
                $client->setName('jorgito el loco');
                $em->persist($client);
                $em->flush();

            }else{
                $count_booking = sizeof($booking->getIncidences());
                $client = $em->getRepository('SystemBackendBundle:Client')->findBy(array('name' => $client_name, 'booking' => $booking));
                if (!$client){
                    $client = new Client();
                    $client->setBooking($booking);
                    $client->setName('jorgito el loco');
                }
            }

            $incidence_type = $em->getRepository('SystemBackendBundle:IncidenceType')->findOneById($request->request->get('incidence_types'));

            $incidence->setBooking($booking);
            $incidence->setService($service);
            $incidence->setIncidenceType($incidence_type);
            $incidence->setCost($request->request->get('final_cost'));
            $incidence->setClousure($request->request->get('clousure'));
            $final_code = $reference.'-'.strval($count_booking);
            $incidence->setCode($final_code);

            $em->persist($incidence);
            $em->flush();

            $who_detected = $em->getRepository('SystemBackendBundle:Person')->findOneById($request->request->get('who_detected'));
            $responsable_corrective_actions = $em->getRepository('SystemBackendBundle:Person')->findOneById($request->request->get('responsable_corrective_actions'));
            $responsable_immediate_actions = $em->getRepository('SystemBackendBundle:Person')->findOneById($request->request->get('responsable_immediate_actions'));

            $incidence_person_w = new Incidence_Person();
            $incidence_person_w->setIncidence($incidence);
            $incidence_person_w->setPerson($who_detected);
            $incidence_person_w->setRol('W');
            $em->persist($incidence_person_w);

            $incidence_person_c = new Incidence_Person();
            $incidence_person_c->setIncidence($incidence);
            $incidence_person_c->setPerson($responsable_corrective_actions);
            $incidence_person_c->setRol('C');
            $em->persist($incidence_person_c);

            $incidence_person_i = new Incidence_Person();
            $incidence_person_i->setIncidence($incidence);
            $incidence_person_i->setPerson($responsable_immediate_actions);
            $incidence_person_i->setRol('I');
            $em->persist($incidence_person_i);



//
            if($request->request->get('responsable')){
                $incidence_person_responsable = $em->getRepository('SystemBackendBundle:Person')->findOneById($request->request->get('responsable'));
                $incidence_person_r = new Incidence_Person();
                $incidence_person_r->setIncidence($incidence);
                $incidence_person_r->setPerson($incidence_person_responsable);
                $incidence_person_r->setRol('R');
                $em->persist($incidence_person_r);
            }

            $em->flush();



            return $this->redirectToRoute('incidence_show', array('id' => $incidence->getId()));
        }

        return $this->render('incidence/new.html.twig', array(
            'incidence' => $incidence,
            'form' => $form->createView(),
            'types' => $types,
            'persons' => $persons
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

    public function getAjaxBookingPersonNamesAction(Request $request){
        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $em = $this->getDoctrine()->getManager();
            $persons = $em->getRepository('SystemBackendBundle:Person')->findAll();

            return $this->render(':incidence:booking_persons.html.twig',array(
                'persons' => $persons,
            ));
        }else{
            return false;
        }
    }

    public function getAjaxCompensationServicesAction(Request $request){
        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $tp_service = $this->get('TPService');
            $services = $tp_service->getBookingServicesWithCostByStatusAndStatus($reference, 'CO');

            return $this->render(':incidence:cost_service.html.twig',array(
                'services' => $services,
                'color' => 'info'
            ));
        }else{
            return false;
        }
    }

    public function getAjaxSustitutionServicesAction(Request $request){
        if($request->isXmlHttpRequest()){
            $reference = $request->request->get('reference');
            $serviceType = $request->request->get('serviceType');
            $tp_service = $this->get('TPService');
            if($serviceType){
                $types = $tp_service->getSimilarServiceTypes($serviceType);
                $services = $tp_service->getBookingServicesWithCostByStatusAndStatus($reference, 'OK', $types );
                $color = 'success';
            }else{
                $services = $tp_service->getBookingServicesWithCostByStatusAndStatus($reference, 'CZ');
                $color = 'danger';
            }

            return $this->render(':incidence:cost_service.html.twig',array(
                'services' => $services,
                'color' => $color
            ));
        }else{
            return false;
        }
    }

}