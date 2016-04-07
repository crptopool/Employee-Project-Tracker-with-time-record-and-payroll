<?php

namespace EdgeWeb\Project\EmployeeBundle\Entity;

/**
 * Timerecord
 */
class Timerecord
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $timein;

    /**
     * @var \DateTime
     */
    private $timeout;

    /**
     * @var string
     */
    private $createdby;

    /**
     * @var string
     */
    private $updatedby;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var \DateTime
     */
    private $dateupdated;

    private $totalhour;

    private $overtime;

    public function getTotalHours()
    {
        /*$start = explode(':', $this->getTimein());
        $end = explode(':', $this->getTimeout());
        $total_hours = $end[0] - $start[0] - ($end[1] < $start[1]);
        return $total_hours;*/
        $total_hours = (int)date('G', abs(strtotime($this->getTimein())-strtotime($this->getTimeout())));
        return $total_hours;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        //to do logics here
        $this->workingday = new \DateTime();
        $this->datecreated = new \DateTime();
       // $this->totalhour = $this->getTotalHours();
    }

    /**
     * Set timein
     *
     * @param \DateTime $timein
     *
     * @return Timerecord
     */
    public function setTimein($timein)
    {
        $this->timein = $timein;

        return $this;
    }

    public function getWorkedHours()
    {
        //if already timein and currently working, get total hour from timein to current time
        if (!empty($this->timein) && empty($this->timeout)) {

            //return "calculate time and current time";
            $start = $this->timein;
            $end = date('H:i:s');
            $start1 = $start->format('H:i:s');

            $total_hours = round((strtotime($end) - strtotime($start1)));//option1 
            
            return gmdate("H:i:s", $total_hours);

        } elseif (!empty($this->timein) && !empty($this->timeout)) {
            //if already timed in and timed out, calculate hours from timein to timeout
            $start = $this->timein;
            $end = $this->timeout;
            $start1 = $start->format('H:i:s');
            $end1 = $end->format('H:i:s');
            $total_hours = round((strtotime($end1) - strtotime($start1)));//option1 
            
            return gmdate("H:i:s", $total_hours);
        }

    }
    
    /**
     * Get timein
     *
     * @return \DateTime
     */
    public function getTimein()
    {
        return $this->timein;
    }

    /**
     * Set timeout
     *
     * @param \DateTime $timeout
     *
     * @return Timerecord
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return \DateTime
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    public function getRemark()
    {
       // if ($this->getWorkedHours() == 8) {
           // return $this->getWorkedHours();
        //}
       // return "to do, late or not late";
        $time = explode(':', $this->getWorkedHours());
        $hours = (int)$time[0] . '.' . $time[1];
        return $hours;
    }

    public function getOtOrUnderTime()
    {
        $time = explode(':', $this->getWorkedHours());
        $hours = (int)$time[0];
        $standard_hour = 8;
        $ot = $hours - $standard_hour;
        if ($hours > $standard_hour) {
            return $ot. '.' . $time[1] . '(o.t)'; 
        } else {
            return 'undertime';
        }
    }

    /**
     * @var \EdgeWeb\Project\UserBundle\Entity\User
     */
    private $users;


    /**
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Timerecord
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdby
     *
     * @return string
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set updatedby
     *
     * @param string $updatedby
     *
     * @return Timerecord
     */
    public function setUpdatedby($updatedby)
    {
        $this->updatedby = $updatedby;

        return $this;
    }

    /**
     * Get updatedby
     *
     * @return string
     */
    public function getUpdatedby()
    {
        return $this->updatedby;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return Timerecord
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set dateupdated
     *
     * @param \DateTime $dateupdated
     *
     * @return Timerecord
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;

        return $this;
    }

    /**
     * Get dateupdated
     *
     * @return \DateTime
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * Set users
     *
     * @param \EdgeWeb\Project\UserBundle\Entity\User $users
     *
     * @return Timerecord
     */
    public function setUsers(\EdgeWeb\Project\UserBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \EdgeWeb\Project\UserBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @var \DateTime
     */
    private $workingday;


    /**
     * Set workingday
     *
     * @param \DateTime $workingday
     *
     * @return Timerecord
     */
    public function setWorkingday($workingday)
    {
        $this->workingday = $workingday;

        return $this;
    }

    /**
     * Get workingday
     *
     * @return \DateTime
     */
    public function getWorkingday()
    {
        return $this->workingday;
    }

    public function isOwner(\EdgeWeb\Project\UserBundle\Entity\User $user = null)
    {
        return $user->getUsername() == $this->getUsers()->getUsername();
    }

    public function setTotalhour($totalhour)
    {
        $this->totalhour = $totalhour;

        return $this;
    }

   
    public function getTotalhour()
    {
        return $this->totalhour;
    }

    public function setOvertime($overtime)
    {
        $this->overtime = $overtime;

        return $this;
    }

   
    public function getOvertime()
    {
        return $this->overtime;
    }
}
