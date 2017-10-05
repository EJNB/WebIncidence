<?php

namespace System\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ServiceTypeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code',IntegerType::class,array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Codigo'
                ),
                'required' => true
            ))
            ->add('name',TextType::class,array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre'
                ),
                'required' => true

            ))
            ->add('itemtype',EntityType::class,array(
                'class' => 'System\BackendBundle\Entity\ItemType',
                'attr' => array(
                    'Title' => 'Seleccione el tipo de item',
                    'class' => 'selectpicker',
                    'data-live-search' => 'true',
                    'required' => 'required'
                ),
//                'required' => true
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'System\BackendBundle\Entity\ServiceType'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_backendbundle_servicetype';
    }


}
