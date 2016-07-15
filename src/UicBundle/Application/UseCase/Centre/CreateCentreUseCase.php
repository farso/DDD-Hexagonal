<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Domain\Entity\Centre\Centre;
use UicBundle\Domain\Entity\Centre\Address;
use UicBundle\Application\UseCase\Centre\FindOneByCentreUseCase;
use UicBundle\Application\UseCase\TipusCentre\FindOneByTipusCentreUseCase;
use UicBundle\Application\Factory\CentreFactory;
use UicBundle\Application\UseCase\Centre\CentreUseCase;

class CreateCentreUseCase extends CentreUseCase
{
   
    public function run(array $params)
    {

        //@todo FALTA SABER COM FUNCIONA EL FINDBY PER FER-HO SERVIR CORRECTAMENT
        // $centreFindOneByUseCase = new FindOneByCentreUseCase($this->centreRepository);
        // $entity = $centreFindOneByUseCase->run(array("codi"=>$params['codi']));

        $this->codeExists($params['codi']);
        $this->nameExists($params['nombre']);

        //@todo validació de variables per lògica complexa (que el nom sigui la composició de 3 + 2, ...)
        //   les validacions d'entitat haurien d'anar repetides a tots els uses cases o no?
               
               
        // tipusCentre
        $tipusCentre = $this->tipusCentreRepository->find($params['tipusCentre']);
        $params['tipusCentre'] = $tipusCentre;

        $address = new Address($params['carrer']);
        $params['address'] = $address;

        $centreFactory = new CentreFactory();
        $centre = $centreFactory->create($params);
        
        $this->centreRepository->create($centre);

        return $centre;
    }
}
