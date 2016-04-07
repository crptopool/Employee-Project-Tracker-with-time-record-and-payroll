<?php

namespace EdgeWeb\Project\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file',array(
              'required' => false,
              'attr' => array(
                'multiple' => 'multiple',
              )
            ))
            ->add('name')
            ->add('description', 'textarea', array(
                'attr' => array('rows' => 5),
            ))
            ->add('start')
            ->add('end')
            ->remove('createdby')
            ->remove('updatedby')
            ->remove('dateupdated')
            ->remove('datecreated')
           /* ->add('project', 'entity', array(
              'class' => 'EmployeeBundle:Project',
              'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('p')
                      ->select('p.name');
                      ->where('p.id = :id')
                      ->setParameter('id', $this->id)
              },
              'multiple' => false
            ))*/
            ->remove('project')
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
