<?php

namespace System\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IncidenceTypeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Inserte el tipo de Incidencia'
                ),
                'label' => false,
                'required' => true
            ))
//            ->add('incidence',EntityType::class,array(
//                'class' => 'System\BackendBundle\Entity\Incidence',
//                'attr' => array(
//                    'Title' => 'Seleccione la incidencia',
//                    'class' => 'selectpicker',
//                    'data-live-search' => true,
//                    'required' => 'required'
//                ),
//                'label' => false,
////                'required' => true
//            ))
;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'System\BackendBundle\Entity\IncidenceType'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_backendbundle_incidencetype';
    }


}
