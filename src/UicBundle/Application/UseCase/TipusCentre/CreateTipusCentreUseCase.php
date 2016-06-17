<?php

namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
use UicBundle\Domain\Entity\TipusCentre\TipusCentre;
use UicBundle\Application\UseCase\TipusCentre\FindOneByTipusCentreUseCase;
use UicBundle\Application\Factory\TipusCentreFactory;

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
