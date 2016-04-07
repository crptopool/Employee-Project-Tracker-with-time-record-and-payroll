<?php

namespace EdgeWeb\Project\EmployeeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EdgeWeb\Project\EmployeeBundle\Entity\Position;
use EdgeWeb\Project\EmployeeBundle\Form\PositionType;

/**
 * Position controller.
 *
 */
class PositionController extends Controller
{

    /**
     * Lists all Position entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmployeeBundle:Position')->findAll();

        return $this->render('EmployeeBundle:Position:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Position entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Position();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->container->get('security.context')->getToken()->getUser();
            $userName = $user->getUsername();
            $entity->setCreatedby($userName);
            $em->persist($entity);
            $em->flush();

            $this->addFlash('success', 'Success!');
            return $this->redirect($this->generateUrl('position', array('id' => $entity->getId())));
        }

        $this->addFlash('danger', 'Error!');
        return $this->render('EmployeeBundle:Position:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Position entity.
     *
     * @param Position $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Position $entity)
    {
        $form = $this->createForm(new PositionType(), $entity, array(
            'action' => $this->generateUrl('position_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Position entity.
     *
     */
    public function newAction()
    {
        $entity = new Position();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmployeeBundle:Position:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Position entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Position')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Position entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $this->addFlash('success', 'Success!');
        return $this->render('EmployeeBundle:Position:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Position entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Position')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Position entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Position:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Position entity.
    *
    * @param Position $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Position $entity)
    {
        $form = $this->createForm(new PositionType(), $entity, array(
            'action' => $this->generateUrl('position_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Position entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Position')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Position entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        //get the current date
        $currentDate = new \DateTime();
        if ($editForm->isValid()) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $currentUser = $user->getUsername();
            $entity->setUpdatedby($currentUser);
            $entity->setDateupdated($currentDate);
            $em->flush();

            $this->addFlash('success', 'Success!');
            return $this->redirect($this->generateUrl('position_edit', array('id' => $id)));
        }

        return $this->render('EmployeeBundle:Position:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Position entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmployeeBundle:Position')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Position entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        $this->addFlash('success', 'Success.Deleted!');
        return $this->redirect($this->generateUrl('position'));
    }

    /**
     * Creates a form to delete a Position entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('position_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
