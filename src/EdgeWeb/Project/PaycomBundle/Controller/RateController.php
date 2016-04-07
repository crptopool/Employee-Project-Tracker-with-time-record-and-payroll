<?php

namespace EdgeWeb\Project\PaycomBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EdgeWeb\Project\PaycomBundle\Entity\Rate;
use EdgeWeb\Project\PaycomBundle\Form\RateType;

/**
 * Rate controller.
 *
 */
class RateController extends Controller
{

    /**
     * Lists all Rate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PaycomBundle:Rate')->findAll();

        return $this->render('PaycomBundle:Rate:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Rate entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Rate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $currentDate = new \DateTime();
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             //get the current loggedin user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $userName = $user->getUsername();
            $entity->setCreatedBy($userName);
            $entity->setDateCreated($currentDate);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rate_show', array('id' => $entity->getId())));
        }

        return $this->render('PaycomBundle:Rate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Rate entity.
     *
     * @param Rate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Rate $entity)
    {
        $form = $this->createForm(new RateType(), $entity, array(
            'action' => $this->generateUrl('rate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Rate entity.
     *
     */
    public function newAction()
    {
        $entity = new Rate();
        $form   = $this->createCreateForm($entity);

        return $this->render('PaycomBundle:Rate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Rate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaycomBundle:Rate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PaycomBundle:Rate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Rate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaycomBundle:Rate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PaycomBundle:Rate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Rate entity.
    *
    * @param Rate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Rate $entity)
    {
        $form = $this->createForm(new RateType(), $entity, array(
            'action' => $this->generateUrl('rate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Rate entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaycomBundle:Rate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rate entity.');
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

            return $this->redirect($this->generateUrl('rate_edit', array('id' => $id)));
        }

        return $this->render('PaycomBundle:Rate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Rate entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PaycomBundle:Rate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rate'));
    }

    /**
     * Creates a form to delete a Rate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
