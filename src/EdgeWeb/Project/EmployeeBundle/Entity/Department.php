<?php

namespace EdgeWeb\Project\EmployeeBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Department
 */
class Department 
{
   
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $department;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $createdby;

    /**
     * @var string
     */
    private $updatedby;

    /**
     * @var string
     */
    private $dateupdated;

    /**
     * @var \DateTime
     */
    private $datecreated;

    public function __toString()
    {
        return $this->department;
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
     * Set department
     *
     * @param string $department
     *
     * @return Department
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Department
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Department
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
     * @return Department
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
     * Set dateupdated
     *
     * @param string $dateupdated
     *
     * @return Department
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;

        return $this;
    }

    /**
     * Get dateupdated
     *
     * @return string
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return Department
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $positions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->positions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->datecreated = new \DateTime();
    }

    /**
     * Add position
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Position $position
     *
     * @return Department
     */
    public function addPosition(\EdgeWeb\Project\EmployeeBundle\Entity\Position $position)
    {
        $this->positions[] = $position;

        return $this;
    }

    /**
     * Remove position
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Position $position
     */
    public function removePosition(\EdgeWeb\Project\EmployeeBundle\Entity\Position $position)
    {
        $this->positions->removeElement($position);
    }

    /**
     * Get positions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Validators
    */
   

    /**
    * validations
    *
    */

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    
        $metadata->addConstraint(new UniqueEntity(array(
            'fields'  => 'department',
        )));
    }
}
