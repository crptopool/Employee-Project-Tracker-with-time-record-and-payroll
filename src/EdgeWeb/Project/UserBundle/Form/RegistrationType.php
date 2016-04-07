<?php

namespace EdgeWeb\Project\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position')
            ->add('roles','collection', array(
                'type' => 'choice',
                'options' => array(
                    'choices' => array(
                        'ROLE_USER' => 'ROLE_USER',
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                    )
                )
            ))
            ->add('enabled','choice', array(
                'choices' => array('1' =>'1','0' => '0'),
                'expanded' => true,
            ))
        ;
    }

    public function getParent()
    {
       // return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
       return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    } //use this for Symfony 2.8.*

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}