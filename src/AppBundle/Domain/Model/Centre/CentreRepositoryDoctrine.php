<?php

namespace AppBundle\Domain\Model\Centre;

use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\EntityManager;
use ApplicationBundle\Contract\CentreRepositoryInterface;
use ApplicationBundle\Factory\CentreFactory;
use DomainBundle\Entity\Centre\Centre;
use AppBundle\Factory\CentreFactoryInf;
use AppBundle\Factory\TipusCentreFactoryInf;
use AppBundle\Adapter\Logs\LogsAdapter;

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
        $centre = parent::find($id);

        return $centre;
    }

    /**
     * Finds all entities in the repository.
     *
     * @return array The entities (DOMAIN).
     */
    public function findAll()
    {
        $centresDom = parent::findAll();
        
        return $centresDom;
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

        $centresInf = parent::findBy($criteria, $orderBy, $limit, $offset);

        return $centresInf;
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
        $centre = parent::findOneBy($criteria, $orderBy);
        
        return $centre;
    }



    public function create(Centre $centre)
    {
        $em = $this->getEntityManager();

        $em->persist($centre);
        $em->flush();

        // S'activa el sistema de LOG (Rabbit)
        // $logAdapter = new LogsAdapter();
        // $logAdapter->writeLog('666','Hello hell!!');

        return $centre;
    }

    public function update()
    {
        $em = $this->getEntityManager();

        $em->flush();

        // S'activa el sistema de LOG (Rabbit)
        // $logAdapter = new LogsAdapter();
        // $logAdapter->writeLog('666','Update hell to sky!!');
    }



    public function delete(Centre $centre)
    {
        $em = $this->getEntityManager();

        $em->remove($centre);
        $em->flush();

        // S'activa el sistema de LOG (Rabbit)
        // $logAdapter = new LogsAdapter();
        // $logAdapter->writeLog('666','Bye hell!!');
    }
}
