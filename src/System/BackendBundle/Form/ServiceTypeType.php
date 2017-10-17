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
            ->add('code',TextType::class,array(
                'attr' => array(
                    'placeholder' => 'Codigo',
                ),
                'label' => false,
                'required' => true
            ))
            ->add('name',TextType::class,array(
                'attr' => array(
                    'placeholder' => 'Nombre'
                ),
                'label' => false,
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
                'label'=> false
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
