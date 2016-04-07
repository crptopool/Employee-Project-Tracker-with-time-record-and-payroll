<?php

namespace EdgeWeb\Project\EmployeeBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * (c) Ian Russel Adem <ian.russel@yahoo.com>
 * Task
 */
class Task
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
    private $dateupdated;

    /**
     * @var \DateTime
     */
    private $datecreated;
    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var \EdgeWeb\Project\EmployeeBundle\Entity\Project
     */
    private $project;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Task
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
     * @return Task
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Task
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Task
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Task
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
     * @return Task
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
     * @return Task
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
     * @return Task
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
     * Set project
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Project $project
     *
     * @return Task
     */
    public function setProject(\EdgeWeb\Project\EmployeeBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \EdgeWeb\Project\EmployeeBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    public function getWorkedHours()
    {
        //calculate hours
        if (!empty($this->start) && !empty($this->end)) {
            //if start and end time is filled calculate hours from start to end
            $start = $this->start;
            $end = $this->end;
            $start1 = $start->format('H:i');
            $end1 = $end->format('H:i');
            $total_hours = round((strtotime($end1) - strtotime($start1)));//option1 
            
            return gmdate("H:i", $total_hours);
        }
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;


    /**
     * Add comment
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Comment $comment
     *
     * @return Task
     */
    public function addComment(\EdgeWeb\Project\EmployeeBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \EdgeWeb\Project\EmployeeBundle\Entity\Comment $comment
     */
    public function removeComment(\EdgeWeb\Project\EmployeeBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
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

    //pseudo code to get number of hours
    public function getHoursWorkedSum() 
    {    
        $sum = 0;
        foreach ($this->getWorkedHours() as $workedHours) {
            $sum += $workedHours;
        }

        return $sum;
     }

    public function getH()
    {
       
        $hr = ($this->end->getTimestamp() - $this->start->getTimestamp()) / 60;
     
        $hour = gmdate("H:i:s", $hr);

        return $hour;
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

    public function isOwner(\EdgeWeb\Project\UserBundle\Entity\User $user = null)
    {
        return $user->getUsername() == $this->getCreatedby();
    }
    /**
     * @var \EdgeWeb\Project\EmployeeBundle\Entity\Upload
     */
    private $upload;


    /**
     * Set path
     *
     * @param string $path
     *
     * @return Task
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
