<?php

namespace EdgeWeb\Project\EmployeeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EdgeWeb\Project\EmployeeBundle\Entity\Task;
use EdgeWeb\Project\EmployeeBundle\Form\TaskType;
use EdgeWeb\Project\EmployeeBundle\Entity\Project;

/**
 * Task controller.
 *
 */
class TaskController extends Controller
{

    /**
     * Lists all Task entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //getWorkedHours()

        $entities = $em->getRepository('EmployeeBundle:Task')->findAll();

        return $this->render('EmployeeBundle:Task:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Task entity.
     *
     */
    public function createAction(Request $request, $project_id)
    {
        $project = $this->getProject($project_id);
        $entity = new Task();
        $entity->setProject($project);
        $form = $this->createForm(new TaskType, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->upload();
             //get the current loggedin user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $userName = $user->getUsername();
            $entity->setCreatedBy($userName);
            $em->persist($entity);
            $em->flush();

            $this->addFlash('success', 'Success!');
            return $this->redirect($this->generateUrl('project_show', array(
                'id' => $entity->getProject()->getId())) . 
                '#task-' . $entity->getId()
            );
        }
        
        $form->add('submit', 'submit', array('label' => 'Create'));

        $this->addFlash('danger', 'Error!');
        return $this->render('EmployeeBundle:Task:create.html.twig', array(
            'task' => $entity,
            'form'   => $form->createView(),
        ));

    }


    /**
     * Displays a form to create a new Task entity.
     *
     */
    public function newAction($project_id)
    {
        $project = $this->getProject($project_id);
        $entity = new Task();
        $entity->setProject($project);
        $form   = $this->createForm(new TaskType(), $entity);

        return $this->render('EmployeeBundle:Task:form.html.twig', array(
            'task' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function getProject($project_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $project = $em->getRepository('EmployeeBundle:Project')->find($project_id);

        if (!$project) {
            throw $this->createNotFoundException('Unable to find Project.');
        }

        return $project;
    }
    private function createCreateForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('task_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    /**
     * Finds and displays a Task entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }
        $comments = $em->getRepository('EmployeeBundle:Comment')
                   ->getCommentsForTask($entity->getId());


        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Task:show.html.twig', array(
            'task'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'comments' => $comments,
        ));
    }
     /**
     * Displays a form to edit an existing Task entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Task:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Task entity.
    *
    * @param Task $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('task_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Task entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        $currentDate = new \DateTime();
        if ($editForm->isValid()) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $currentUser = $user->getUsername();
            $entity->setUpdatedby($currentUser);
            $entity->setDateupdated($currentDate);
            $em->flush();

            return $this->redirect($this->generateUrl('task_edit', array('id' => $id)));
        }

        return $this->render('EmployeeBundle:Task:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Task entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmployeeBundle:Task')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Task entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('task'));
    }

    /**
     * Creates a form to delete a Task entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

}
