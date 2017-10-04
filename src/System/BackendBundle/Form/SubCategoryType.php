<?php

namespace System\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SubCategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,array(
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Inserte la subcategoria'
            )
        ))
        ->add('category',EntityType::class,array(
            'class' => 'System\BackendBundle\Entity\Category',
            'attr' => array(
                'Title' => 'Seleccione la categoria',
                'class' => 'selectpicker',
                'data-live-search' => true
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
