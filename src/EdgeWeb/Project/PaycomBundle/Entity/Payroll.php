<?php

namespace EdgeWeb\Project\PaycomBundle\Entity;

/**
 * Payroll
 */
class Payroll
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $hours;

    /**
     * @var integer
     */
    private $days;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \DateTime
     */
    private $dateFrom;

    /**
     * @var \DateTime
     */
    private $dateTo;

    /**
     * @var integer
     */
    private $overtime;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $updatedBy;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \DateTime
     */
    private $updatedDate;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * @var float
     */
    private $rate;

    private $holiday_pay;

    private $incentives;

    private $deductions;

    private $deduction_desc;

    public function subtractDays()
    {
        $currentDate = new \DateTime();
        $currentDate->sub(new \DateInterval('P10D'));
        return $currentDate;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateFrom = $this->subtractDays();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \DateTime();
        $this->dateTo = new \DateTime();
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

    /**
     * Set hours
     *
     * @param string $hours
     *
     * @return Payroll
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return string
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set days
     *
     * @param string $days
     *
     * @return Payroll
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return string
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Payroll
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Payroll
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     *
     * @return Payroll
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     *
     * @return Payroll
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set overtime
     *
     * @param integer $overtime
     *
     * @return Payroll
     */
    public function setOvertime($overtime)
    {
        $this->overtime = $overtime;

        return $this;
    }

    /**
     * Get overtime
     *
     * @return integer
     */
    public function getOvertime()
    {
        return $this->overtime;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Payroll
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     *
     * @return Payroll
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Payroll
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Payroll
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Payroll
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
     * Set rate
     *
     * @param float $rate
     *
     * @return Payroll
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    public function setHolidayPay($holiday_pay)
    {
        $this->holiday_pay = $holiday_pay;

        return $this;
    }

    public function getHolidayPay()
    {
        return $this->holiday_pay;
    }

    public function setIncentives($incentives)
    {
        $this->incentives = $incentives;

        return $this;
    }

   
    public function getIncentives()
    {
        return $this->incentives;
    }

    public function setDeductions($deductions)
    {
        $this->deductions = $deductions;

        return $this;
    }

    public function getDeductions()
    {
        return $this->deductions;
    }

    public function setDeductionDesc($deduction_desc)
    {
        $this->deduction_desc = $deduction_desc;

        return $this;
    }

    public function getDeductionDesc()
    {
        return $this->deduction_desc;
    }

}
