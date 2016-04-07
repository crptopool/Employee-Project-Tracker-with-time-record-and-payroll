<?php

namespace EdgeWeb\Project\EmployeeBundle\Twig;

class ProjectNameExtension extends \Twig_Extension
{
protected $em;

//private $date = date('Y-m-d');

public function __construct($em)
{
  $this->em = $em;
}

public function getFunctions()
{
  return array(
    //this is the name of the function you will use in twig
    new \Twig_SimpleFunction('project_name', array($this, 'getProjectName'))
  );
}

public function getName()
{
  //return 'number_employees';
  return 'projectname_extension';
}   
// $date = date('Y-m-d');
public function getProjectName($id)
  {
    $date = date('Y-m-d');
    $qb=$this->em->createQueryBuilder();
    $qb->select('p.name')
      ->from('EmployeeBundle:Project','p')
      ->join('p.tasks','t')
      ->where('t.id = :x')
      ->setParameter('x',$this->id);
    $name = $qb->getQuery()->getScalarResult(); 
    return $name;
  }
}