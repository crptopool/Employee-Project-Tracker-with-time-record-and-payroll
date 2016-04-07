<?php

namespace EdgeWeb\Project\EmployeeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EdgeWeb\Project\EmployeeBundle\Entity\Comment;
use EdgeWeb\Project\EmployeeBundle\Form\CommentType;
use EdgeWeb\Project\EmployeeBundle\Entity\Task;

/**
 * Task controller.
 *
 */
class CommentController extends Controller
{

    /**
     * Lists all Comment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmployeeBundle:Comment')->findAll();

        return $this->render('EmployeeBundle:Comment:index.html.twig', array(
            'comments' => $entities,
        ));
    }
    /**
     * Creates a new Comment entity.
     *
     */
    public function createAction(Request $request, $task_id)
    {
        $task = $this->getTask($task_id);
        $entity = new Comment();
        $entity->setTask($task);
        $form = $this->createForm(new CommentType, $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             //get the current loggedin user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $userName = $user->getUsername();
            $entity->setCreatedBy($userName);
            $em->persist($entity);
            $em->flush();

            $this->addFlash('success', 'Success!');
            return $this->redirect($this->generateUrl('task_show', array(
                'id' => $entity->getTask()->getId())) . 
                '#comment-' . $entity->getId()
            );
        }
        
        $form->add('submit', 'submit', array('label' => 'Add Your Comments'));
        
        $this->addFlash('danger', 'Error!');
        return $this->render('EmployeeBundle:Comment:create.html.twig', array(
            'comment' => $entity,
            'form'   => $form->createView(),
        ));

    }


    /**
     * Displays a form to create a new Comment entity.
     *
     */
    public function newAction($task_id)
    {
        $task = $this->getTask($task_id);
        $entity = new Comment();
        $entity->setTask($task);
        $form   = $this->createForm(new CommentType(), $entity);

        return $this->render('EmployeeBundle:Comment:form.html.twig', array(
            'comment' => $entity,
            'form'   => $form->createView(),
        ));
    }
    private function createCreateForm(Comment $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('comment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    /**
     * Finds and displays a Comment entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Comment:show.html.twig', array(
            'comment'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
     /**
     * Displays a form to edit an existing Comment entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Comment:edit.html.twig', array(
            'comment'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Comment entity.
    *
    * @param Comment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Comment $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('comment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Comment entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
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

            $this->addFlash('success', 'Sucess!');
            return $this->redirect($this->generateUrl('comment_edit', array('id' => $id)));
        }

        return $this->render('EmployeeBundle:Comment:edit.html.twig', array(
            'comment'      => $entity,
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
            $entity = $em->getRepository('EmployeeBundle:Comment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comment'));
    }

    /**
     * Creates a form to delete a Comment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function getTask($task_id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $task = $em->getRepository('EmployeeBundle:Task')->find($task_id);

        if (!$task) {
            throw $this->createNotFoundException('Unable to find Task.');
        }

        return $task;
    }

}
