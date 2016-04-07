<?php

namespace EdgeWeb\Project\EmployeeBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Project
 */
class Project
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $datestarted;

    /**
     * @var \DateTime
     */
    private $datefinished;

    /**
     * @var string
     */
    private $status;

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

    public function getTotalHours()
    {
        $date = '2007-05-14';
        $datetime = strtotime("$date 00:00:00");

        $tasks = array();
        foreach ($this->tasks as $task) {
            $tasks[] = $task->getWorkedHours();
        }
        $sum = 0;
        foreach($tasks as $time) {
            $sum += strtotime("$date $time") - $datetime;
        }

        return gmdate("H:i", $sum);
    }
   
    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
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
     * Set datestarted
     *
     * @param \DateTime $datestarted
     *
     * @return Project
     */
    public function setDatestarted($datestarted)
    {
        $this->datestarted = $datestarted;

        return $this;
    }

    /**
     * Get datestarted
     *
     * @return \DateTime
     */
    public function getDatestarted()
    {
        return $this->datestarted;
    }

    /**
     * Set datefinished
     *
     * @param \DateTime $datefinished
     *
     * @return Project
     */
    public function setDatefinished($datefinished)
    {
        $this->datefinished = $datefinished;

        return $this;
    }

    /**
     * Get datefinished
     *
     * @return \DateTime
     */
    public function getDatefinished()
    {
        return $this->datefinished;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Project
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
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Project
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
     * @return Project
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
     * @param string $datecreated
     *
     * @return Project
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return string
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
     * @return Project
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tasks;

   /* public function isOwner(\EdgeWeb\Project\UserBundle\Entity\User $user = null)
    {
        return $user->getUsername() == $this->getUser()->getUsername();
    }
    */
    
    /**
     * Add task
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Task $task
     *
     * @return Project
     */
    public function addTask(\EdgeWeb\Project\EmployeeBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;
        //$task->setProject($this);
        return $this;
        
    }

    /**
     * Remove task
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Task $task
     */
    public function removeTask(\EdgeWeb\Project\EmployeeBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }
    /**
     * @var \DateTime
     */
    private $eta;


    /**
     * Set eta
     *
     * @param \DateTime $eta
     *
     * @return Project
     */
    public function setEta($eta)
    {
        $this->eta = $eta;

        return $this;
    }

    /**
     * Get eta
     *
     * @return \DateTime
     */
    public function getEta()
    {
        return $this->eta;
    }

    /**
     * Constructor
     */
   /* public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->datecreated = new \DateTime();
    }*/
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \EdgeWeb\Project\UserBundle\Entity\User $user
     *
     * @return Project
     */
    public function addUser(\EdgeWeb\Project\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \EdgeWeb\Project\UserBundle\Entity\User $user
     */
    public function removeUser(\EdgeWeb\Project\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
   
     /**
     * handling the file uploads
     * 
     */
    
    public $path;

    public $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        //return __DIR__.'/../../../../web/'.$this->getUploadDir();
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

     /**
    * validations
    *
    */

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    
        $metadata->addConstraint(new UniqueEntity(array(
            'fields'  => 'name',
        )));
    }

   /* public function isOwner(\EdgeWeb\Project\UserBundle\Entity\User $user = null)
    {
        return $user->getUsername() == $this->getCreatedby();
    }*/
}
