<?php

namespace EdgeWeb\Project\EmployeeBundle\Twig;

class AlreadyTimedInExtension extends \Twig_Extension
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
    new \Twig_SimpleFunction('already_timed_in', array($this, 'timedin'))
  );
}

public function getName()
{
  //return 'number_employees';
  return 'alreadytimedin_extension';
}   
// $date = date('Y-m-d');
public function timedin($id)
  {
    $date = date('Y-m-d');
    $qb=$this->em->createQueryBuilder();
    $qb->select('u.id')
      ->from('UserBundle:User','u')
      ->join('u.timerecords','t')
      ->where('u.id = :x')
      ->andWhere('t.workingday LIKE :date')
      ->setParameter('date', $date)
      ->setParameter('x',$id);
    $timedin = $qb->getQuery()->getScalarResult(); 
    return $timedin;
  }
}