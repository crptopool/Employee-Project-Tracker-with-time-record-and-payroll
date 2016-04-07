<?php

namespace EdgeWeb\Project\EmployeeBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Permission
 */
class Permission
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $permission;

    public function __toString()
    {
        return $this->permission;
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
     * Set permission
     *
     * @param string $permission
     *
     * @return Permission
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return string
     */
    public function getPermission()
    {
        return $this->permission;
    }
    /**
     * @var string
     */
    private $createdby;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->timerecords = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateupdated= new \DateTime();
        $this->datecreated = new \DateTime();
    }

    /**
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Permission
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
     * @var string
     */
    private $updatedby;

    /**
     * @var \DateTime
     */
    private $dateupdated;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * Set updatedby
     *
     * @param string $updatedby
     *
     * @return Permission
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
     * @param \DateTime $dateupdated
     *
     * @return Permission
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
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return Permission
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
    * validations
    *
    */

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    
        $metadata->addConstraint(new UniqueEntity(array(
            'fields'  => 'permission',
        )));
    }
}
