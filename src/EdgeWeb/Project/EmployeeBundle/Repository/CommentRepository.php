<?php

namespace EdgeWeb\Project\EmployeeBundle\Repository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
	public function findRelatedComments($project)
	{
		return $this
            ->createQueryBuilder('c')
            ->select('c')
           // ->where('c.project LIKE :id')->setParameter('id', $project)
            ->orderBy('c.datecreated', 'DESC')
            ->getQuery()
            ->getResult()
        ;
	}
    public function getCommentsForTask($taskId)
    {
        $qb = $this->createQueryBuilder('c')
                   ->select('c')
                   ->where('c.task = :task_id')
                   ->addOrderBy('c.datecreated','DESC')
                   ->setParameter('task_id', $taskId);


        return $qb->getQuery()
                  ->getResult();
    }

   /* public function findLatestComments($task)
    {
        return $this
            ->createQueryBuilder('p')
            ->select('p')
           // ->where('c.project LIKE :id')->setParameter('id', $project)
            ->orderBy('p.datecreated', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }*/
}