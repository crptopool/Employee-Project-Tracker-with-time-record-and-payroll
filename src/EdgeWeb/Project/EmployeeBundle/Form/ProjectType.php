<?php

namespace EdgeWeb\Project\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users', 'entity', array(
              'class' => 'UserBundle:User',
              'label' => 'Assign to this Developer(s)',
              'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('u')
                      ->orderBy('u.username', 'ASC');
              },
              'expanded' => true,
              'multiple' => true
            ))
            // ->add('users')
            ->add('name', 'text', array(
              'label' => 'Project Name'
            ))
            ->add('description','textarea')
            ->add('eta', 'date', array(
                'empty_value' => 'ETA',
                'widget' => 'single_text',
                //'format' => 'dd-MM-yyyy',
                'attr' => array('class'=>'date-calendar')
            ))
            ->add('datestarted', 'date', array(
                'widget' => 'single_text',
               // 'format' => 'dd-MM-yyyy',
                'attr' => array('class'=>'date-calendar')
            ))
            ->add('datefinished', 'date', array(
                'widget' => 'single_text',
               // 'format' => 'dd-MM-yyyy',
                'attr' => array('class'=>'date-calendar')
            ))
            ->add('status','choice', array(
              'empty_value' => 'Status',
              'error_bubbling' => true,
              'choices' => array('Pending' => 'Pending', 'Ongoing' => 'Ongoing', 'Finished' => 'Finished','Extended' => 'Extended'),
              'label' => 'Project Status',
              'required' => true,
          ))
            ->add('file','file',array(
              'required' => false,
            ))
            ->remove('createdby')
            ->remove('updatedby')
            ->remove('datecreated')
            ->remove('dateupdated')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EdgeWeb\Project\EmployeeBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edgeweb_project_employeebundle_project';
    }
}
