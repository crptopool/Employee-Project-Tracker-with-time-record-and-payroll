<?php

namespace EdgeWeb\Project\EmployeeBundle\Twig;

class ProjectRelatedTaskExtension extends \Twig_Extension
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
    new \Twig_SimpleFunction('projecttask', array($this, 'projecttask'))
  );
}

public function getName()
{
  //return 'number_employees';
  return 'projecttask_extension';
}   

public function projecttask($id)
  {
   
    $qb=$this->em->createQueryBuilder();
    $qb->select('t.name')
      ->from('EmployeeBundle:Task','t')
      ->join('t.project','p')
      ->where('p.id = :x')
      ->setParameter('x',$id);
    $currentid = $qb->getQuery()->getScalarResult(); 
    return $currentid;
  }

  /*$qb=$this->em->createQueryBuilder();
    $qb->select('count(v.id)')
      ->from('DuterteBundle:Voters','v')
      ->join('v.grps','g')
     // ->join('c.province','p')
     // ->join('p.region','r')
     // ->join('r.island','i')
      ->where('g.id = :x')
      ->setParameter('x',$id);
    $count = $qb->getQuery()->getSingleScalarResult(); 
    return $count;*/
}