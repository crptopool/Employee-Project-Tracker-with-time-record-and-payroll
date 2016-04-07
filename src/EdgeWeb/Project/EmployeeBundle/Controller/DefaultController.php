<?php

namespace EdgeWeb\Project\EmployeeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        //return $this->render('EmployeeBundle:Default:index.html.twig', array('name' => $name));
        return $this->render('EmployeeBundle:Default:index.html.twig');
    }

    public function homepageAction()
    {
    	return $this->render('EmployeeBundle:Default:homepage.html.twig');
    }
}
