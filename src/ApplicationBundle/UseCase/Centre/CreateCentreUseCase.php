<?php

namespace ApplicationBundle\UseCase\Centre;

use ApplicationBundle\Contract\CentreRepositoryInterface;
use ApplicationBundle\Contract\TipusCentreRepositoryInterface;
use DomainBundle\Entity\Centre\Centre;
use ApplicationBundle\UseCase\Centre\FindOneByCentreUseCase;
use ApplicationBundle\UseCase\TipusCentre\FindOneByTipusCentreUseCase;
use ApplicationBundle\Factory\CentreFactory;

class CreateCentreUseCase
{
    /**
    *
    * var CentreRepositoryInterface
    */
    private $centreRepository;

    /**
    *
    * var TipusCentreRepositoryInterface
    */
    private $tipusCentreRepository;

    public function __construct(CentreRepositoryInterface $centreRepository)
    // , TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->centreRepository = $centreRepository;
        // $this->tipusCentreRepository = $tipusCentreRepository;
    }

    public function run(array $params)
    {

        //@todo FALTA SABER COM FUNCIONA EL FINDBY PER FER-HO SERVIR CORRECTAMENT
        // $centreFindOneByUseCase = new FindOneByCentreUseCase($this->centreRepository);
        // $entity = $centreFindOneByUseCase->run(array("codi"=>$params['codi']));

        $centre = $this->centreRepository->findBy(array("codi"=>$params['codi']));

        if (count($centre) != 0) {
            throw new \Exception('ja existeix el codi!!');
        }

        $centre = $this->centreRepository->findBy(array("nombre"=>$params['nombre']));

        if (count($centre) != 0) {
            throw new \Exception('ja existeix el nom!!');
        }

            //@todo validació de variables per lògica complexa (que el nom sigui la composició de 3 + 2, ...)
            //   les validacions d'entitat haurien d'anar repetides a tots els uses cases o no?
               
               
        // tipusCentre
        // $tipusCentreFindOneByUseCase = new FindOneByTipusCentreUseCase($this->tipusCentreRepository);
        // $tipusCentreDom = $tipusCentreFindOneByUseCase->run(array('id' => $params['tipusCentre']));
      
        // $params['tipusCentre'] = $tipusCentreDom;
        $centreFactory = new CentreFactory();
        $centre = $centreFactory->create($params);
        
        $this->centreRepository->create($centre);

        return $centre;
    }
}
