<?php

namespace System\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubCategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text',array(
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Subcategory'
            )
        ))
        ->add('category','entity',array(
            'class' => 'System\BackendBundle\Entity\Category',
            'attr' => array(
                'placeholder' => 'Seleccione la categoria',
                'class' => 'selectpicker'
            )
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'System\BackendBundle\Entity\SubCategory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_backendbundle_subcategory';
    }


}
