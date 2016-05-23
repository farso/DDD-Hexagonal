<?php

namespace AppBundle\Adapter\Repository;

use  \Doctrine\ORM\EntityRepository;
use  \Doctrine\ORM\EntityManager;
use  Uic\Application\Contract\CentreRepositoryInterface;
use  Uic\Application\Factory\CentreFactory;
use  AppBundle\Factory\CentreFactoryInf;
use  AppBundle\Adapter\Logs\LogsAdapter;

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
    	$centreInf = parent::find($id);

        $centreDom = null;
        if (null !== $centreInf) {
            $centreDom = CentreFactory::instance($centreInf->toArray());
        }

        return $centreDom;
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

        $centresInf = parent::findBy($criteria,$orderBy,$limit,$offset);

        $centresDom = array();
        foreach($centresInf as $centreInf) {
            $centreDom = CentreFactory::instance($centreInf->toArray());
            
            $centresDom[] = $centreDom;
        }
        return $centresDom;

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
        $centreInf = parent::findOneBy($criteria,$orderBy);
        
        $centreDom = null;
        if (null !== $centreInf) {
            $centreDom = CentreFactory::instance($centreInf->toArray());
        }

        return $centreDom;
    }



    public function create(array $params)
    {

        $em = $this->getEntityManager();
        //@todo Crear array per especificacions. DE moment a ma (en aplicacio???)

        $centreDom = CentreFactory::create($params);

        $centreInf = CentreFactoryInf::create($centreDom->toArray());

        $em->persist($centreInf);
        $em->flush();

        // S'activa el sistema de LOG (Rabbit)
        $logAdapter = new LogsAdapter();
        $logAdapter->writeLog('666','Hello hell!!');

        return $centreDom;
    }

    public function update(array $params)
    {
        $em = $this->getEntityManager();

        $centreDom = CentreFactory::instance($params);

        $centreInf = parent::find($params['id']);

        //@todo agafar per Specification patten els
        if (null !== $centreInf) {
            $centreInf->setNombre($params['nombre']);
            $centreInf->setCodi($params['codi']);
            $centreInf->setMailCentre($params['mailCentre']);
            $centreInf->setCodiOficial($params['codiOficial']);
            $centreInf->setColor($params['color']);

            $em->flush();  

            // S'activa el sistema de LOG (Rabbit)
            $logAdapter = new LogsAdapter();
            $logAdapter->writeLog('666','Update hell to sky!!');  
        }


        
        
        return $centreDom;
    }



    public function delete($id)
    {
        $em = $this->getEntityManager();

        $centreInf = parent::find($id);

        $em->remove($centreInf);
        $em->flush();

        // S'activa el sistema de LOG (Rabbit)
        $logAdapter = new LogsAdapter();
        $logAdapter->writeLog('666','Bye hell!!');  
    }


}
