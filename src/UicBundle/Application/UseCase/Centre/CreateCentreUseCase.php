<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Domain\Entity\Centre\Centre;
use UicBundle\Domain\Entity\Centre\Address;
use UicBundle\Application\Factory\CentreFactory;
use UicBundle\Application\UseCase\Centre\CentreUseCase;

class CreateCentreUseCase extends CentreUseCase
{
    public function run(array $params)
    {

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
