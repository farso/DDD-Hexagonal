<?php

namespace ApplicationBundle\UseCase\TipusCentre;

use ApplicationBundle\Contract\TipusCentreRepositoryInterface;
use DomainBundle\Entity\TipusCentre\TipusCentre;
use ApplicationBundle\UseCase\TipusCentre\FindOneByTipusCentreUseCase;
use ApplicationBundle\Factory\TipusCentreFactory;

class CreateTipusCentreUseCase
{
    /**
    *
    * var TipusCentreRepositoryInterface
    */
    private $tipusCentreRepository;

    public function __construct(TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->tipusCentreRepository = $tipusCentreRepository;
    }

    public function run(array $params)
    {

            //@todo validació de variables per lògica complexa (que el nom sigui la composició de 3 + 2, ...)
            //   les validacions d'entitat haurien d'anar repetides a tots els uses cases o no?
            //  


        $tipusCentreFactory = new TipusCentreFactory();
        $tipusCentre = $tipusCentreFactory->create($params);

        $this->tipusCentreRepository->create($tipusCentre);

        return $tipusCentre;
    }
}
