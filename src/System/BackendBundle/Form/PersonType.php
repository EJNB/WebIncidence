<?php

namespace System\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,array(
                'label' => 'Correo'
            ))
            ->add('username',TextType::class,array(
                'label' => 'Usuario'
            ))
//            'password',PasswordType::class
            ->addEventListener(FormEvents::PRE_SET_DATA,function(FormEvent $event){
                $person = $event->getData();//Returns the data associated with this event.
                $form = $event->getForm();//Returns the form at the source of the event.
                // check if the Person object is "new", If no data is passed to the form, the data is "null".
                // This should be considered a new "Person"
                if(!$person || null===$person->getId()){
                    $form
                        ->add('password',PasswordType::class)
                        ->add('password',RepeatedType::class,array(
                            'type' => PasswordType::class,
                            'invalid_message' => 'Sus contraseñas no coincidir',
                            'required' => true,
                            'first_options' => array('label' => 'Contraseña'),
                            'second_options' => array('label' => 'Repita la contraseña')
                        ));
                }
            })
            ->add('name',TextType::class,array(
                'label' => 'Nombre y apellidos'
            ))
            ->add('occupation',TextType::class,array(
                'label' => 'Cargo'
            ))
            ->add('isActive',CheckboxType::class)
            ->add('consultant')
            ->add('roles')
            ->add('department');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'System\BackendBundle\Entity\Person'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'system_backendbundle_person';
    }


}
