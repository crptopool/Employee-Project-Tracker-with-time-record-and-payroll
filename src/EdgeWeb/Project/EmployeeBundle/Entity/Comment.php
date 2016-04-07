<?php

namespace EdgeWeb\Project\EmployeeBundle\Entity;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comment;

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
    private $datecreated;

    /**
     * @var \DateTime
     */
    private $dateupdated;
    /**
     * @var \EdgeWeb\Project\EmployeeBundle\Entity\Project
     */
    private $project;

    public function __construct()
    {
        $this->datecreated = new \DateTime();
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
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @var \EdgeWeb\Project\EmployeeBundle\Entity\Task
     */
    private $task;


    /**
     * Set task
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Task $task
     *
     * @return Comment
     */
    public function setTask(\EdgeWeb\Project\EmployeeBundle\Entity\Task $task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \EdgeWeb\Project\EmployeeBundle\Entity\Task
     */
    public function getTask()
    {
        return $this->task;
    }
}
