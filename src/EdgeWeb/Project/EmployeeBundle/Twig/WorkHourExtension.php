<?php

namespace EdgeWeb\Project\EmployeeBundle\Twig;

class WorkHourExtension extends \Twig_Extension
{

  public function getFunctions()
  {
    return array(
      //this is the name of the function you will use in twig
      new \Twig_SimpleFunction('number_work_hour', array($this, 'getWorkedHours'))
    );
  }

  public function getName()
  {
  return 'number_work_extension';
  }   

  public function getWorkedHours($start, $end)
  {
    
    $start1 = $start->format('H:i:s');
    $end1 = $end->format('H:i:s');
    $total_hours = round((strtotime($end1) - strtotime($start1)));//option1 
    
    return gmdate("H:i:s", $total_hours);
  }   
}