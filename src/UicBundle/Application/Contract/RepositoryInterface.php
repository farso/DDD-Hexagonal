<?php

namespace UicBundle\Application\Contract;
use UicBundle\Domain\Entity\Entity;

/**
 * RepositoryInterface
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
/**
 * Interface RepositoryInterface
 * @package UicBundle\Application\Contract
 */
interface RepositoryInterface
{
   
  	/**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $id     The identifier.
     * @return object|null  The entity instance or NULL if the entity can not be found.
     */
     function find($id); 

	
    /**
     * Finds all entities in the repository.
     *
     * @return array The entities.
     */
    function findAll();
	
    /**
     * Finds entities by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     */
    function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
    
    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    function findOneBy(array $criteria, array $orderBy = null);




    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     *
     * @param Entity    $entity
     * @throws \Doctrine\ORM\OptimisticLockException If a version check on an entity that
     *         makes use of optimistic locking fails.
     */
    //public function update(Entity $entity);

}
