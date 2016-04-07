<?php

namespace EdgeWeb\Project\EmployeeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EdgeWeb\Project\EmployeeBundle\Entity\Timerecord;
use EdgeWeb\Project\EmployeeBundle\Form\TimerecordType;

/**
 * Timerecord controller.
 *  ian russel adem(symfony fanatic)
 */
class TimerecordController extends Controller
{

    /**
     * Lists all Timerecord entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $date = date('Y-m-d');

        $entities = $em->getRepository('EmployeeBundle:Timerecord')->findTimeInToday($date);

        return $this->render('EmployeeBundle:Timerecord:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    public function showIndividualTimeRecordsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmployeeBundle:Timerecord')->findAll();
        return $this->render('EmployeeBundle:Timerecord:showIndividualTimeRecords.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Timerecord entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Timerecord();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        //check if the current user is already timedin
       $currentTime = new \DateTime();
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //get the current loggedin user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $userId = $user->getId();
            $userName = $user->getUsername();
            $alreadyTimedIn = $this->container->get('employee.alreadytimedin_extension');
            $alreadyLoggedIn = $alreadyTimedIn->timedin($userId);
            /* var_dump($alreadyLoggedIn);
            echo '<pre>';
        \Doctrine\Common\Util\Debug::dump(count($alreadyLoggedIn));
        echo '</pre>';
           
            die();*/
            if (count($alreadyLoggedIn) >= 1) {
                //to do: pass an error 
                $this->addFlash('danger', 'Hi' . ' , ' . $userName . ' ' . 'You are currently logged');
            } else {
            $entity->setTimein($currentTime);
            $entity->setUsers($user);
            $entity->setCreatedBy($user);
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('timerecord_show', array('id' => $entity->getId())));
            $this->addFlash('success', 'Hi' . ' ' . $userName . ' , ' . 'You are successsfully logged!');

            return $this->redirect($this->generateUrl('project_show_individual'));
            }
        }

        /*return $this->render('EmployeeBundle:Timerecord:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));*/
        return $this->redirect($this->generateUrl('project_show_individual'));
    }

    /**
     * Creates a form to create a Timerecord entity.
     *
     * @param Timerecord $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Timerecord $entity)
    {
        $form = $this->createForm(new TimerecordType(), $entity, array(
            'action' => $this->generateUrl('timerecord_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'timein', 'attr' => array('class' => 'click_timein')));

        return $form;
    }

    /**
     * Displays a form to create a new Timerecord entity.
     *
     */
    public function newAction()
    {
        $entity = new Timerecord();
        $form   = $this->createCreateForm($entity);

        $em = $this->getDoctrine()->getManager();

        $date = date('Y-m-d');
        

        //find and fetch all already timedin users for this date;
        $alreadytimedinusers = $em->getRepository('EmployeeBundle:Timerecord')->findTimeInToday($date);
        return $this->render('EmployeeBundle:Timerecord:new.html.twig', array(
            'alreadytimedinuser' => $alreadytimedinusers,
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Timerecord entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Timerecord')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Timerecord entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Timerecord:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Timerecord entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Timerecord')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Timerecord entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Timerecord:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Timerecord entity.
    *
    * @param Timerecord $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Timerecord $entity)
    {
        $form = $this->createForm(new TimerecordType(), $entity, array(
            'action' => $this->generateUrl('timerecord_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'TimeOut'));

        return $form;
    }
    /**
     * Edits an existing Timerecord entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Timerecord')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Timerecord entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        /*** get total woked hours in a day **/
        $totalHours = $entity->getWorkedHours();
        //$totalHours = (float) preg_replace('/^(\d+):(\d+).+/','\1.\2',$totalHours);
        $time = explode(':', $totalHours);
        $hours = (int)$time[0] . '.' . $time[1];

        /*** now we want to calculate and save overtime hours if any **/
        $regular_time = 8.00;
        $initial_ot = 1.00;
        $maybe_ot = $hours - $regular_time;
       
        if ($hours > $regular_time && $maybe_ot >= 1) {
            $overtime = $maybe_ot;
        } else {
            $overtime = 0;
        }

        $currentDate = new \DateTime();
        if ($editForm->isValid()) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $currentUser = $user->getUsername();
            $entity->setUpdatedby($currentUser);
            $entity->setDateupdated($currentDate);
            $entity->setTotalhour($hours);
            $entity->setTimeout($currentDate);
            $entity->setOvertime($overtime);
            $em->flush();
            $this->addFlash('success', 'Go Home' . ' ' . $currentUser);

            return $this->redirect($this->generateUrl('timerecord', array('id' => $id)));
        } else {
            return $this->redirect($this->generateUrl('timerecord_edit', array('id' => $id)));
        }
       /* $this->addFlash('danger', $currentUser . ' , ' . 'Please check errors!');

        return $this->render('EmployeeBundle:Timerecord:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));*/
    }
    /**
     * Deletes a Timerecord entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmployeeBundle:Timerecord')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Timerecord entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('timerecord'));
    }

    /**
     * Creates a form to delete a Timerecord entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('timerecord_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
