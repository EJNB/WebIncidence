<?php

namespace System\BackendBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


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
            ->add('incidenceDate',DateType::class,array(
                'label' => 'Fecha',
                'widget' => 'single_text',
                'attr' => array('class' => 'format_date_time'),
                'required' => true,
                'input' => 'datetime',
            ))
            //causas
            ->add('causes', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'language' => 'es',
                    'jquery' => true,
                    'input_sync' => true
                    //...
                ),
                'required' => true,
                'label' => 'Causas',
            ))
            //description
            ->add('description', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'language' => 'es'
                    //...
                ),
                'attr' => array(
                    'placeholder' => 'Descripción de la incidencia'
                ),
                'required' => true,
                'label' => 'Descripción'
            ))
            //acciones correctivas
            ->add('corrective_actions',CKEditorType::class,array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'language' => 'es'
                    //...
                ),
                'label' => 'Acciones correctivas: ',
//                'required' => true
            ))
            //acciones inmediatas
            ->add('immediate_actions',CKEditorType::class,array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'language' => 'es'
                    //...
                ),
                'label' => 'Acciones inmediatas: ',
                'attr' => array(
                    'placeholder' => 'Introdusca las acciones inmediatas'
                ),
//                'required' => true
            ))
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
                'label' => 'Documento (PDF, Docx, Jpeg)',
                'required' => false,
                'data_class' => null//ver esto mañana
            ))
//            ->add('service')
            ->add('place',EntityType::class,array(
                'class' => 'System\BackendBundle\Entity\Place',
                'attr' => array(
                    'class' => 'selectpicker form-control',
                    'data-live-search' => 'true',
                    'title' => 'Seleccione el lugar'
                ),
                'label' => 'Lugar',
                'required' => true
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
