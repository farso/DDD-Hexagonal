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

        $tipusCentreFactory = new TipusCentreFactory();
        $tipusCentre = $tipusCentreFactory->create($params);
        
        $tipusCentre = $this->tipusCentreRepository->create($tipusCentre);

        return $tipusCentre;
    }
}
