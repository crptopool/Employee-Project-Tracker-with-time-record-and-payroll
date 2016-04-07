<?php

namespace EdgeWeb\Project\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
#use Doctrine\ORM\EntityRepository;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', 'textarea', array(
                'attr' => array('rows' => 5),
            ))
            ->remove('createdby')
            ->remove('updatedby')
            ->remove('datecreated')
            ->remove('dateupdated')
            ->remove('task', 'entity', array(
              'class' => 'EmployeeBundle:Task',
              'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('t')
                      ->orderBy('t.name', 'ASC');
              },
          ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EdgeWeb\Project\EmployeeBundle\Entity\Comment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edgeweb_project_employeebundle_comment';
    }
}
