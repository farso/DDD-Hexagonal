<?php

namespace AppBundle\Adapter\Repository;
use  \Doctrine\ORM\EntityRepository;
use  \Doctrine\ORM\EntityManager;
use  Uic\Application\Contract\CentreRepositoryInterface;
use  Uic\Application\Factory\CentreFactory;
use  AppBundle\Factory\CentreFactoryInf;

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



    public function create($nom, $codi, $mailCentre, $codiOficial)
    {

        $em = $this->getEntityManager();
        //@todo Crear array per especificacions. DE moment a ma (en aplicacio???)

        $centreDades = array();
        //$id = $centreInf['id'];
        $centreDades['nombre'] = $nom;
        $centreDades['codi'] = $codi;
        $centreDades['mailCentre'] = $mailCentre;
        $centreDades['codiOficial'] = $codiOficial;
        $centreDom = CentreFactory::create($centreDades);


        
        $centreInf = CentreFactoryInf::create($centreDom->toArray());

        $em->persist($centreInf);
        $em->flush();

        return $centreDom;
    }

    public function update($id, $nom, $codi, $mailCentre, $codiOficial)
    {
        $em = $this->getEntityManager();

        $centreDades = array();
        $centreDades['id'] = $id;
        $centreDades['nombre'] = $nom;
        $centreDades['codi'] = $codi;
        $centreDades['mailCentre'] = $mailCentre;
        $centreDades['codiOficial'] = $codiOficial;

        $centreDom = CentreFactory::instance($centreDades);

        $centreInf = parent::find($id);

        if (null !== $centreInf) {
            $centreInf->setNombre($nom);
            $centreInf->setCodi($codi);
            $centreInf->setMailCentre($mailCentre);
            $centreInf->setCodiOficial($codiOficial);

            $em->flush();    
        }


        
        
        return $centreDom;
    }



    public function delete($id)
    {
        $em = $this->getEntityManager();

        $centreInf = parent::find($id);

        $em->remove($centreInf);
        $em->flush();
    }
}
