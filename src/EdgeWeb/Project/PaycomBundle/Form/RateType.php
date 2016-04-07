<?php

namespace EdgeWeb\Project\PaycomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users')
            ->add('monthlyRate', 'choice', array(
                'choices' => array(
                    '5000' => '5,000',
                    '8000' => '8,000',
                    '9000' => '9,000',
                    '10000' => '10,000',
                    '11000' => '11,000',
                    '12000' => '12,000',
                    '13000' => '13,000',
                    '14000' => '14,000',
                    '15000' => '15,000',
                    '16000' => '16,000',
                    '17000' => '17,000',
                    '18000' => '18,000',
                    '19000' => '19,000',
                    '20000' => '20,000',
                    '21000' => '21,000',
                    '22000' => '22,000',
                    '23000' => '23,000',
                    '24000' => '24,000',
                    '25000' => '25,000',
                    '26000' => '25,000',
                    '27000' => '27,000',
                    '28000' => '28,000',
                    '29000' => '29,000',
                    '30000' => '30,000',
                    '31000' => '31,000',
                    '32000' => '32,000',
                    '33000' => '33,000',
                    '34000' => '34,000',
                    '35000' => '35,000',
                    '1000000' => '1,000,000'
                ) 
            )) 
            ->add('hourlyRate')
            ->remove('createdBy')
            ->remove('updatedBy')
            ->remove('dateCreated')
            ->remove('dateUpdated')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EdgeWeb\Project\PaycomBundle\Entity\Rate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edgeweb_project_paycombundle_rate';
    }
}
