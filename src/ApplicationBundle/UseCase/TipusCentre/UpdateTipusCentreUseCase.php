<?php

namespace ApplicationBundle\UseCase\TipusCentre;

use ApplicationBundle\Contract\TipusCentreRepositoryInterface;

class UpdateTipusCentreUseCase
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

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($this->tipusCentreRepository);
        $entity = $tipusCentreFindUseCase->run($params['id']); 

        if (null === $entity) {
            //@todo excepcions
            throw new \Exception("no s'ha trobat l'entitat");
        }

            //@todo validació de variables per lògica complexa (que el nom sigui la composició de 3 + 2, ...)
            //   les validacions d'entitat haurien d'anar repetides a tots els uses cases o no?
            //   

        $entity = $this->tipusCentreRepository->update($params); 

        return $entity;
    }
}
