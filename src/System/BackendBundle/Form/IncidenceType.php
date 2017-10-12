<?php

namespace System\BackendBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class IncidenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('code',NumberType::class,array(
//                'label' => 'Codigo'
//            ))
            ->add('incidenceDate')
            ->add('causes')
            ->add('description')
//            ->add('incidenceType', EntityType::class, array(
//                'class' => 'System\BackendBundle\Entity\IncidenceType',
////                'choice_label' => 'Tipo de incidencia',
//                'attr' => array(
//                    'class' => 'icheck',
//                    'onchange' => 'changeRadio(this.value)'
//                ),
//                'expanded' => true,
//                'multiple' => false,
//
//
//            ))
            ->add('document',FileType::class,array(
                'label' => 'Documento (PDF file)'
            ))
//            ->add('service')
            ->add('place',TextType::class,array(
                'label' => 'Lugar',
            ));
//            ->add('claim');
//            ->add('booking');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'System\BackendBundle\Entity\Incidence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_backendbundle_incidence';
    }


}
