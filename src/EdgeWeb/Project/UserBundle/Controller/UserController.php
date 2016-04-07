<?php

namespace EdgeWeb\Project\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EdgeWeb\Project\EmployeeBundle\Entity\Comment;
use EdgeWeb\Project\EmployeeBundle\Entity\Task;
use EdgeWeb\Project\EmployeeBundle\Repository\TaskRepository;

class UserController extends Controller
{
    public function allUserAction()
    {
    	//$allUser = 'me';

    	$em = $this->getDoctrine()->getManager();

        $allUser = $em->getRepository('UserBundle:User')->findAll();

        return $this->render('UserBundle:User:allUser.html.twig', array(
           	'allUser' => $allUser
        ));    
    }

    public function showTransactionsAction(Request $request, $id)
    {
      
    	$em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserBundle:User')->find($id);//find all user id


        $tasks = $em->getRepository('EmployeeBundle:Task')->getTasksForUser($user->getUsername());
          //paginator
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tasks,
            $request->query->getInt('page', 1)/*page number*/,
            15/*limit per page*/
        );
     
        return $this->render('UserBundle:User:showTransactions.html.twig', array(
        	'transactions' => $pagination,
        	'username' => strtoupper($user->getUsername()),
        ));
    }
}
