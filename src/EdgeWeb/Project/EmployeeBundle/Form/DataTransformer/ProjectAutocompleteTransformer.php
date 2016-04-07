<?php

namespace EdgeWeb\Project\EmployeeBundle\Form\DataTransformer;

use EdgeWeb\Project\EmployeeBundle\Entity\Project;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class ProjectAutocompleteTransformer implements DataTransformerInterface
{
 	private $entityManager;
 	
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
 
    public function transform($project)
    {
        if (null === $project) {
            return '';
        }
 
        return $project->getName();
    }
 
    public function reverseTransform($projectName)
    {
        
        if (!$projectName) {
        	return;
        }

        $project = $this->entityManager
        	->getRepository('EmployeeBundle:Project')->findOneBy(array('name' => $projectName));
 
        if (null === $project) {
            throw new TransformationFailedException(sprintf('There is no "%s" exists',
            	$projectName
            ));
        }
 
        return $project;
    }
}