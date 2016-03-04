<?php

namespace AppBundle\Adapter\Repository;
use  \Doctrine\ORM\EntityRepository;
use  \Doctrine\ORM\EntityManager;
use  Uic\Application\Contract\CentreRepositoryInterface;
use  Uic\Application\Factory\CentreFactory;
use  AppBundle\Entity\Centre;

/**
 * CentreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CentreRepositoryDoctrine extends \Doctrine\ORM\EntityRepository implements CentreRepositoryInterface 
{
    
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $id     The identifier.
     * @return object|NULL  The entity instance or NULL if the entity can not be found. (DOMAIN)
     */
    public function find($id)
    {
    	$entity = parent::find($id);

        $centre = null;
        if (null !== $entity) {
            $centre = CentreFactory::create($entity->getId(), $entity->getNombre(), $entity->getCodi());
        }

        return $centre;
    } 

	
    /**
     * Finds all entities in the repository.
     *
     * @return array The entities (DOMAIN).
     */
    public function findAll()
	{    
        $entities = parent::findAll();
        $centres = array();
        foreach($entities as $entity) {

            $centre = CentreFactory::create($entity->getId(), $entity->getNombre(), $entity->getCodi());
            
            $centres[] = $centre;
        }
        
        return $centres;
    }  

     /**
     * Finds entities by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects. (DOMAIN)
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $entities = parent::findBy($criteria,$orderBy,$limit,$offset);

        $centres = array();
        foreach($entities as $entity) {

            $centre = CentreFactory::create($entity->getId(), $entity->getNombre(), $entity->getCodi());
            
            $centres[] = $centre;
        }
        
        return $centres;

    }

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found. (DOMAIN)
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $entity = parent::findOneBy($criteria,$orderBy);
        
        $centre = null;
        if (null !== $entity) {
            $centre = CentreFactory::create($entity->getId(), $entity->getNombre(), $entity->getCodi());
        }

        return $centre;
    }



    public function create($nom, $codi)
    {
        $em = $this->getEntityManager();

        //@todo ID per surrogate
        $entity = new Centre($nom, $codi);

        $em->persist($entity);
        $em->flush();

        $centre = CentreFactory::create($entity->getId(), $entity->getNombre(), $entity->getCodi());
        
        return $centre;
    }

    public function update($id, $nom, $codi)
    {
        $em = $this->getEntityManager();

        $entity = parent::find($id);

        if (null !== $entity) {
            $entity->setNombre($nom);
            $entity->setCodi($codi);

            $em->flush();    
        }


        $centre = CentreFactory::create($entity->getId(), $entity->getNombre(), $entity->getCodi());
        
        return $centre;
    }



    public function delete($id)
    {
        $em = $this->getEntityManager();

        $entity = parent::find($id);

        $em->remove($entity);
        $em->flush();
    }
}