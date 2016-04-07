<?php

namespace EdgeWeb\Project\EmployeeBundle\Twig;

class CurrentIdProjectExtension extends \Twig_Extension
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
    new \Twig_SimpleFunction('currentidproject', array($this, 'projectid'))
  );
}

public function getName()
{
  //return 'number_employees';
  return 'currentidproject_extension';
}   

public function projectid($id)
  {
   
    $qb=$this->em->createQueryBuilder();
    $qb->select('p.id')
      ->from('EmployeeBundle:Project','p')
      ->where('p.id = :x')
      ->setParameter('x',$id);
    $currentid = $qb->getQuery()->getScalarResult(); 
    return $currentid;
  }
}