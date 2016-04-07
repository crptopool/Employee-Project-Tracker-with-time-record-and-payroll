<?php

namespace EdgeWeb\Project\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
   // private $id;
    protected $id;

    public function __construct()
    {
        parent::__construct();
        //your own logic here
    }

    /**
     * Get id
     *
     * @return integer
     */
    
    protected $roles = array();
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $timerecords;

    private $payrolls;

    private $rates;

    /**
     * @var \EdgeWeb\Project\EmployeeBundle\Entity\Position
     */
    private $position;


    /**
     * Add timerecord
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Timerecord $timerecord
     *
     * @return User
     */
    public function addTimerecord(\EdgeWeb\Project\EmployeeBundle\Entity\Timerecord $timerecord)
    {
        $this->timerecords[] = $timerecord;

        return $this;
    }

    /**
     * Remove timerecord
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Timerecord $timerecord
     */
    public function removeTimerecord(\EdgeWeb\Project\EmployeeBundle\Entity\Timerecord $timerecord)
    {
        $this->timerecords->removeElement($timerecord);
    }

    /**
     * Get timerecords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimerecords()
    {
        return $this->timerecords;
    }

     /**
     * Add payroll
     *
     * @param \EdgeWeb\Project\PaycomBundle\Entity\Payroll $payroll
     *
     * @return User
     */
    public function addPayroll(\EdgeWeb\Project\PaycomBundle\Entity\Payroll $payroll)
    {
        $this->payrolls[] = $payroll;

        return $this;
    }

    /**
     * Remove payroll
     *
     * @param \EdgeWeb\Project\PaycomBundle\Entity\Payroll $payroll
     */
    public function removePayroll(\EdgeWeb\Project\PaycomBundle\Entity\Payroll $payroll)
    {
        $this->payrolls->removeElement($payroll);
    }

    /**
     * Get payroll
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayrolls()
    {
        return $this->payrolls;
    }


    /**
     * Set position
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Position $position
     *
     * @return User
     */
    public function setPosition(\EdgeWeb\Project\EmployeeBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \EdgeWeb\Project\EmployeeBundle\Entity\Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }
}
