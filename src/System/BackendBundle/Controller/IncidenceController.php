<?php

namespace System\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

            $reference = $request->request->get('select_reference');//busco el booking
            $optid = $request->request->get('service');//dame el servicio de la incidencia
            $service = $em->getRepository('SystemBackendBundle:Service')->findOneByTourplanId($optid);
            if(!$service){//si exite el servicio no esta en mi db
                $supplier = new Supplier();
                $service = new Service();

                $data_service = $tp_service->getServiceDescriptionByOPT($optid);//busco el servicio en turplan
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

            //para el caso de q el booking no sea nuevo
            $booking = $em->getRepository('SystemBackendBundle:Booking')->findOneByCode($reference);
            $count_booking = 1;
            if(!$booking){ // si el booking no existe, es decir q no tiene incidencia asociada
                $data_booking = $tp_service->getBookingGeneralData($reference);
                $booking = new Booking();
                $booking->setName($data_booking['BOOKING_NAME']);
                $booking->setCode($data_booking['FULL_REFERENCE']);
                $booking->setAgent($data_booking['AGENT_NAME']);
                $booking->setConsultant($data_booking['CONSULTANT_NAME']);
//                traveldate
//                $booking->set($data_booking['TRAVELDATE']);
                $em->persist($booking);
                $em->flush();

            }else{//significa q el booking existe en mi bd y tiene alguna incidencia asociada
                $count_booking = count($booking->getIncidences())+1;
//                $client = $em->getRepository('SystemBackendBundle:Client')->findBy(array('name' => $client_name, 'booking' => $booking));
//                if (!$client){
//                    $client = new Client();
//                    $client->setBooking($booking);
////                    $client->setName('jorgito el loco');
//                }
            }

            $incidence_type = $em->getRepository('SystemBackendBundle:IncidenceType')->findOneById($request->request->get('incidence_types'));

            $incidence->setBooking($booking);
            $incidence->setService($service);
            $incidence->setIncidenceType($incidence_type);
//            $incidence->setCostType($request->request->get('cost_type'));//aqui seteo el tipo de costo
            $incidence->setCost($request->request->get('final_cost'));
            $incidence->setClousure($request->request->get('clousure'));
            $final_code = $reference.'-'.strval($count_booking);
            $incidence->setCode($final_code);

            $em->persist($incidence);
            $em->flush();

            //aqui entonces recorreria todo mi arr de clientes y los pondria en el booking
            foreach($request->request->get('clients') as $clave => $valor){
                $client = new Client();
                $client->setName($valor);
                $client->setIncidence($incidence);
                $em->persist($client);
                $em->flush();
            }

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

            if($request->request->get('responsable')){
                $incidence_person_responsable = $em->getRepository('SystemBackendBundle:Person')->findOneById($request->request->get('responsable'));
                $incidence_person_r = new Incidence_Person();
                $incidence_person_r->setIncidence($incidence);
                $incidence_person_r->setPerson($incidence_person_responsable);
                $incidence_person_r->setRol('R');
                $em->persist($incidence_person_r);
            }

            //guardo el documento adjunto
            $file = $incidence->getDocument();
            if($file){//si viene algun documento (pdf,doc o jpg o png)
                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                // Move the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('file_directory'),
                    $fileName
                );
                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                $incidence->setDocument($fileName);
            }
            $em->flush();

            $this->addFlash(
                'notice',
                'Sus datos han sido guardados satisfactoriamente'
            );

            return $this->redirectToRoute('incidence_index');
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
        return $this->render('incidence/show.html.twig', array(
            'incidence' => $incidence,
        ));
    }

    /**
     * Displays a form to edit an existing incidence entity.
     *
     */
    public function editAction(Request $request, Incidence $incidence)
    {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('System\BackendBundle\Form\IncidenceType', $incidence);
        $editForm->handleRequest($request);
        $types = $em->getRepository('SystemBackendBundle:IncidenceType')->findAll();
        $dql = 'SELECT ip,p,i
                FROM SystemBackendBundle:Incidence_Person ip
                JOIN ip.person p
                JOIN ip.incidence i
                WHERE ip.incidence =:incidence
                ';
        $query = $em->createQuery($dql)->setParameter('incidence',$incidence->getId());
        $incidence_persons = $query->getResult();
        $persons = $em->getRepository('SystemBackendBundle:Person')->findAll();

        //buscar los datos del booking
        $tp_service = $this->get('TPService');
        $detail_booking = $tp_service->getBookingGeneralData($incidence->getBooking()->getCode());
        $services_description = $tp_service->getBookingServiceDescription($incidence->getBooking()->getCode());
        $clients = $tp_service->getBookingClientsName($incidence->getBooking()->getCode());
        $suppliers = $tp_service->getBookingSupplier($incidence->getBooking()->getCode());

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $reference = $request->request->get('select_reference');//busco el booking
            $optid = $request->request->get('service');//obtengo el id de turplan del servicio
            $service = $em->getRepository('SystemBackendBundle:Service')->findOneByTourplanId($optid);//lo busco en mi base de

            //quitar el servicio q estaba asociado al booking con proveedores y clientes

            //necesito el id del booking
            if(!$service){//si no exite el servicio en mi bd lo creo
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

            $incidence_type = $em->getRepository('SystemBackendBundle:IncidenceType')->findOneById($request->request->get('incidence_types'));

            $incidence->setService($service);
            $incidence->setIncidenceType($incidence_type);
            $incidence->setCost($request->request->get('final_cost'));
            $incidence->setClousure($request->request->get('clousure'));

            $em->persist($incidence);
            $em->flush();

            //elimino todos los clientes asociados a esta incidencia
            foreach ($incidence->getClients() as $c){
                $em->remove($c);
                $em->flush();
            }

            //introdusco todos clientes q se seleccionaron
            foreach($request->request->get('clients') as $clave => $valor){
                $client = new Client();
                $client->setName($valor);
                $client->setIncidence($incidence);
                $em->persist($client);
                $em->flush();
            }

            //elimino todos los registros de incidence_person asociados a esta incidencia
            foreach ($incidence->getIncidencesPersons() as $i){
                $em->remove($i);
                $em->flush();
            }

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

            //si incidencia fue de tipo de interna
            if($request->request->get('responsable')){
                $incidence_person_responsable = $em->getRepository('SystemBackendBundle:Person')->findOneById($request->request->get('responsable'));
                $incidence_person_r = new Incidence_Person();
                $incidence_person_r->setIncidence($incidence);
                $incidence_person_r->setPerson($incidence_person_responsable);
                $incidence_person_r->setRol('R');
                $em->persist($incidence_person_r);
            }

            //guardo el documento adjunto
            $file = $incidence->getDocument();
            if($file){//si viene algun documento (pdf,doc o jpg o png)
                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                // Move the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('file_directory'),
                    $fileName
                );
                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                $incidence->setDocument($fileName);
            }
            $em->flush();

            $this->addFlash(
                'notice',
                'Sus datos han sido guardados satisfactoriamente'
            );

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('incidence_index');
        }

        return $this->render('incidence/edit.html.twig', array(
            'incidence' => $incidence,
            'edit_form' => $editForm->createView(),
            'types' => $types,
            'persons' => $persons,
            'incidence_persons' => $incidence_persons,
            'booking_detail' => $detail_booking,
            'services_description' => $services_description,
            'clients' => $clients,
            'suppliers' => $suppliers
        ));
    }

    /**
     * Deletes a incidence entity.
     * Si el booking asociado a la incidencia tiene otras incidencias asociadas no puedo eliminarlo
     */
    public function deleteAction(Incidence $incidence)
    {
        $em = $this->getDoctrine()->getManager();
        //buscar el booking al q esta incidencia esta asociada
        $booking = $incidence->getBooking();
        //si el booking no tiene mas incidencias y no tiene reclamaciones asociadas
//        if ($booking->getIncidences()->count()<=1 && $booking->getClaims()->count()==0){
            //elimino los clientes
            foreach ($incidence->getClients() as $client){
                $em->remove($client);
                $em->flush();
            }

            //elimino las personas
            foreach ($incidence->getIncidencesPersons() as $person){
                $em->remove($person);
                $em->flush();
            }

            //elimino la relacion q tenga esta incidencia con alguna reclamacion
            foreach($incidence->getClaims() as $claim){
                $em->remove($claim);
                $em->flush();
            }

            $em->remove($incidence);//elimino la incidencia
//            $em->remove($booking);// y elimino el booking
            $em->flush();
//        } else{//si el booking tiene otras incidencias asociadas o algunas reclamaciones
            //elimino los clientes
            //elimino las personas, como quien detecto responsables de las acciones etc
            //y luego elimino la incidencia
//        }
        $this->addFlash(
            'notice',
            'La incidencia ha sido elimnada satisfactoriamente'
        );
//        dump($booking);
//        $em->remove($incidence);
//        $em->flush();
        return $this->redirectToRoute('incidence_index');
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

    //check si el booking tiene incidencias
    public function getAjaxIncidencesByBookingAction(Request $request){
        if($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $reference = $request->request->get('reference');
            $dql = 'SELECT i,b FROM SystemBackendBundle:Incidence i JOIN i.booking b WHERE b.code=:code';
            $query = $em->createQuery($dql)->setParameter('code',$reference);
            $incidences = $query->getResult();
            if($incidences){

                return $this->render(':incidence:incidences_by_booking.html.twig', array(
                    'incidences' => $incidences
                ));
            }else{
                return false;
            }
        }
    }
}