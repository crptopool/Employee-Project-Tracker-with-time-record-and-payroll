<?php

namespace EdgeWeb\Project\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TimerecordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('timein','time', array(
                'data' => new \DateTime(),
                'input' => 'datetime',
                'widget' => 'choice',
            ))
            ->remove('timeout', 'time', array(
                //'data' => new \DateTime(),
                'empty_value' => '',
                'input' => 'datetime',
                'widget' => 'choice',
            ))
            ->remove('createdby')
            ->remove('updatedby')
            ->remove('datecreated')
            ->remove('dateupdated')
            ->remove('permissions')
            ->remove('totalhour')
            ->remove('overtime')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EdgeWeb\Project\EmployeeBundle\Entity\Timerecord'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edgeweb_project_employeebundle_timerecord';
    }
}
