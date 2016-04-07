<?php

namespace EdgeWeb\Project\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('project')
            ->add('name')
            ->add('description','textarea')
            ->add('start','time', array(
                'data' => new \DateTime(),
                'input' => 'datetime',
                'widget' => 'choice',
            ))
            ->add('end','time', array(
                'data' => new \DateTime(),
                'input' => 'datetime',
                'widget' => 'choice',
            ))
            ->remove('createdby')
            ->remove('updatedby')
            ->remove('dateupdated')
            ->remove('datecreated')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EdgeWeb\Project\EmployeeBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edgeweb_project_employeebundle_task';
    }
}
