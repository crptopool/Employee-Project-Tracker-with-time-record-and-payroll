<?php

namespace EdgeWeb\Project\EmployeeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EdgeWeb\Project\EmployeeBundle\Entity\Permission;
use EdgeWeb\Project\EmployeeBundle\Form\PermissionType;

/**
 * Permission controller.
 *
 */
class PermissionController extends Controller
{

    /**
     * Lists all Permission entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmployeeBundle:Permission')->findAll();

        return $this->render('EmployeeBundle:Permission:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Permission entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Permission();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('permission_show', array('id' => $entity->getId())));
        }

        return $this->render('EmployeeBundle:Permission:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Permission entity.
     *
     * @param Permission $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Permission $entity)
    {
        $form = $this->createForm(new PermissionType(), $entity, array(
            'action' => $this->generateUrl('permission_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Permission entity.
     *
     */
    public function newAction()
    {
        $entity = new Permission();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmployeeBundle:Permission:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Permission entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Permission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Permission entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Permission:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Permission entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Permission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Permission entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmployeeBundle:Permission:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Permission entity.
    *
    * @param Permission $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Permission $entity)
    {
        $form = $this->createForm(new PermissionType(), $entity, array(
            'action' => $this->generateUrl('permission_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Permission entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmployeeBundle:Permission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Permission entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('permission_edit', array('id' => $id)));
        }

        return $this->render('EmployeeBundle:Permission:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Permission entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmployeeBundle:Permission')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Permission entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('permission'));
    }

    /**
     * Creates a form to delete a Permission entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('permission_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
