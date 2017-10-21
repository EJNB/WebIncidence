<?php

namespace System\TPBundle\Service;

use Doctrine\ORM\EntityManager;

class TPService
{
    protected $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function getBookingGeneralData($reference){
        $em = $this->em;

        $general_data = $em->getRepository('SystemBackendBundle:Booking')->findTPBookingGeneralData($reference);

        return $general_data;
    }

    public function getBookingServiceDescription($reference){
        $em = $this->em;

        $services = $em->getRepository('SystemBackendBundle:Booking')->findTPBookingServicesDescription($reference);

        return $services;
    }

    public function getBookingServiceDescriptionBySupplier($supplier, $reference){
        $em = $this->em;

        $services = $em->getRepository('SystemBackendBundle:Booking')->findTPBookingServicesDescriptionBySupplier($supplier, $reference);

        return $services;
    }

    public function getServiceDescriptionByOPT($opt){
        $em = $this->em;

        $service = $em->getRepository('SystemBackendBundle:Booking')->findTPServiceDescriptionByOPT($opt);

        return $service;
    }

    public function getBookingServicesWithCost($reference){
        $em = $this->em;

        $services = $em->getRepository('SystemBackendBundle:Booking')->findTPBookingServicesWithCost($reference);

        return $services;
    }

    public function getBookingClientsName($reference){
        $em = $this->em;

        $clients = $em->getRepository('SystemBackendBundle:Booking')->findTPBookingClientsName($reference);

        return $clients;
    }

    public function getBookingSupplier($reference){
        $em = $this->em;

        $suppliers = $em->getRepository('SystemBackendBundle:Booking')->findTPBookingSuppliers($reference);

        return $suppliers;
    }

    public function getBookingServicesWithCostByStatusAndStatus($reference, $status=null, $serviceType=null){
        $em = $this->em;

        $services = $em->getRepository('SystemBackendBundle:Booking')->findTPBookingServicesWithCostByStatusAndServiceType($reference, $status, $serviceType);

        return $services;
    }

    public function getSimilarServiceTypes($type){
        $em = $this->em;

        $serviceTypes = $em->getRepository('SystemBackendBundle:Booking')->findTPSimilarServiceTypes($type);

        return $serviceTypes;
    }



}