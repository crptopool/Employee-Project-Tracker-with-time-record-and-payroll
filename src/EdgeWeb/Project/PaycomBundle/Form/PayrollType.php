<?php

namespace EdgeWeb\Project\PaycomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PayrollType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users',null, array(
              'label' => 'Employee'
            ))
            ->add('dateFrom',null, array(
              'label' => 'From'
            ))
            ->add('dateTo', null, array(
              'label' => 'To'
            ))
            ->add('rate', null, array(
              'label' => 'Hourly Rate'
            ))
            ->add('holiday_pay','text', array(
                'label' => 'Holiday Pay'
            ))
            ->add('incentives', 'text', array(
                'label' => ' Incentives'
            ))
            ->add('deductions', 'text', array(
                'label' => 'Deductions'
            ))
            ->add('deduction_desc', 'textarea', array(
                'label' => 'Describe deductions here'
            ))
            ->remove('date')
            ->remove('overtime')
            ->remove('createdBy')
            ->remove('updatedBy')
            ->remove('createdDate')
            ->remove('updatedDate')
            ->remove('days')
            ->add('status', 'choice', array(
             'choices' => array(
              'pending' => 'pending',
              'paid' => 'paid',
              )
            ))
           // ->add('rate')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EdgeWeb\Project\PaycomBundle\Entity\Payroll'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edgeweb_project_paycombundle_payroll';
    }
}
