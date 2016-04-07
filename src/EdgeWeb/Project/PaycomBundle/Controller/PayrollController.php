<?php

namespace EdgeWeb\Project\PaycomBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use EdgeWeb\Project\PaycomBundle\Entity\Payroll;
use EdgeWeb\Project\PaycomBundle\Form\PayrollType;

/**
 * Payroll controller.
 *
 */
class PayrollController extends Controller
{

    /**
     * Lists all Payroll entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PaycomBundle:Payroll')->findAll();

        return $this->render('PaycomBundle:Payroll:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Payroll entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Payroll();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        /***** calculate salary **/
        $from = $entity->getDateFrom();
        $to = $entity->getDateTo();
        $user = $entity->getUsers();
        $hours = $em->getRepository('EmployeeBundle:Timerecord')->countWorkedHoursByDateRange($from,$to,$user);
        $ot = $em->getRepository('EmployeeBundle:Timerecord')->countOvertimeByDateRange($from,$to,$user);
        $no_days = $em->getRepository('EmployeeBundle:Timerecord')->countNumberDaysByDateRange($from,$to,$user);
        $createdPayroll = $em->getRepository('PaycomBundle:Payroll')->getCreatedPayrollByEmployeeAndDate($from,$to,$user);

        $rate = $entity->getRate();
        //$rate = $em->getRepository('PaycomBundle:Rate')->getEmployeeRate($user);
        $salary = $hours * $rate;
        $incentives = $entity->getIncentives();
        $holiday_pay = $entity->getHolidayPay();
        $deductions = $entity->getDeductions();

        /**--------------we will check if there is added holiday pay and if true, add to total amount*/

        if ($holiday_pay > 0) {
            $salary = $salary + $holiday_pay;
        }

        /**--------------we will check if there is added incentives pay and if true, add to total amount*/
        if ($incentives > 0) {
            $salary = $salary + $incentives;
        }
        /**--------------we will check if there is added deductions pay and if true, subtract to total amount*/
        if ($deductions > 0) {
            $salary = $salary - $deductions;
        }
        /******/
        $currentDate = new \DateTime();
        if ($form->isValid() && count($createdPayroll) == 0 && count($rate) > 0) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $currentUser = $user->getUsername();
            $entity->setCreatedBy($currentUser);
            $entity->setCreatedDate($currentDate);
            $entity->setHours($hours);
            $entity->setRate($rate);
            $entity->setAmount($salary);
            $entity->setOvertime($ot);
            $entity->setDays($no_days);
            $entity->setIncentives($incentives);
            $entity->setHolidayPay($holiday_pay );
            $entity->setDeductions($deductions);
            /****send emails **/
            $message = \Swift_Message::newInstance()
            ->setSubject('Contact enquiry from symblog')
            ->setFrom('ian.adem@edgewebmedia.com')
            ->setTo('ian.adem@edgewebmedia.com')
            ->setBody('you payroll i screated');
            $this->get('mailer')->send($message);

            $this->addFlash('success', 'Your contact enquiry was successfully sent. Thank you!');
            /*****end send email ***/
            $em->persist($entity);
            $em->flush();
                $this->addFlash('success', 'Success!');
               return $this->redirect($this->generateUrl('payroll_show'));

        } elseif (count($rate) == 0 || is_null($rate)) {
            $this->addFlash('warning', 'No Hourly Rate specified for this employee.');
            return $this->render('PaycomBundle:Payroll:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
        } else {
            $this->addFlash('warning', 'Payroll already created for the the values you entered!');
            return $this->render('PaycomBundle:Payroll:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
        }
    }

    /**
     * Creates a form to create a Payroll entity.
     *
     * @param Payroll $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Payroll $entity)
    {
        $form = $this->createForm(new PayrollType(), $entity, array(
            'action' => $this->generateUrl('payroll_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Payroll entity.
     *
     */
    public function newAction()
    {
        $entity = new Payroll();
        $form   = $this->createCreateForm($entity);

        return $this->render('PaycomBundle:Payroll:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Payroll entity.
     *
     */
   /* public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaycomBundle:Payroll')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payroll entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PaycomBundle:Payroll:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pending_payrolls = $em->getRepository('PaycomBundle:Payroll')->findAllPending();
        $paid_payrolls = $em->getRepository('PaycomBundle:Payroll')->findAllPaid();
        if (count($pending_payrolls) > 0) {
             foreach ($pending_payrolls as $value) {
                $dateFrom = $value->getDateFrom();
                $dateTo = $value->getDate();
            }
        } else {
            foreach ($paid_payrolls as $value) {
                $dateFrom = $value->getDateFrom();
                $dateTo = $value->getDate();
            }
        }
       

        return $this->render('PaycomBundle:Payroll:show.html.twig', array(
            'pending_payrolls' => $pending_payrolls,
            'paid_payrolls' => $paid_payrolls,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ));
    }

    /**
     * Displays a form to edit an existing Payroll entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaycomBundle:Payroll')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payroll entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PaycomBundle:Payroll:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Payroll entity.
    *
    * @param Payroll $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Payroll $entity)
    {
        $form = $this->createForm(new PayrollType(), $entity, array(
            'action' => $this->generateUrl('payroll_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr' => array('class' => 'btn btn-default')));

        return $form;
    }
    /**
     * Edits an existing Payroll entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaycomBundle:Payroll')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Payroll entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Payroll updated!');
            return $this->redirect($this->generateUrl('payroll_show'));
        } else {

            $this->addFlash('warning','Please check for errors!');
            return $this->render('PaycomBundle:Payroll:edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )); 
        }
    }

    public function updatePendingPayrollAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $payroll = new Payroll();
        $form = $this->createFormBuilder($payroll)
            ->add('users')
            ->add('save','submit')
            ->getForm();

    }
    /**
     * Deletes a Payroll entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PaycomBundle:Payroll')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Payroll entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('payroll'));
    }

    /**
     * Creates a form to delete a Payroll entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('payroll_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
