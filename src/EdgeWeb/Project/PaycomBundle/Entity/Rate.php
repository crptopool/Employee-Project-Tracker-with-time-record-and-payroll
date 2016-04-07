<?php

namespace EdgeWeb\Project\PaycomBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Rate
 */
class Rate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $monthlyRate;

    /**
     * @var float
     */
    private $hourlyRate;

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
    private $dateCreated;

    private $users;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    public function __toFloat()
    {
        return (float)$this->monthlyRate;
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
     * Set monthlyRate
     *
     * @param float $monthlyRate
     *
     * @return Rate
     */
    public function setMonthlyRate($monthlyRate)
    {
        $this->monthlyRate = $monthlyRate;

        return $this;
    }

    /**
     * Get monthlyRate
     *
     * @return float
     */
    public function getMonthlyRate()
    {
        return $this->monthlyRate;
    }

    /**
     * Set hourlyRate
     *
     * @param float $hourlyRate
     *
     * @return Rate
     */
    public function setHourlyRate($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;

        return $this;
    }

    /**
     * Get hourlyRate
     *
     * @return float
     */
    public function getHourlyRate()
    {
        return $this->hourlyRate;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Rate
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
     * @return Rate
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Rate
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return Rate
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
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
    * validations
    *
    */

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    
        $metadata->addConstraint(new UniqueEntity(array(
            'fields'  => 'monthlyRate',
        )));
    }
}
