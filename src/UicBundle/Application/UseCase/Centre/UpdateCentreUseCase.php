<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
use UicBundle\Domain\Entity\Centre\Address;

class UpdateCentreUseCase
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

    public function __construct(CentreRepositoryInterface $centreRepository, TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->centreRepository = $centreRepository;
        $this->tipusCentreRepository = $tipusCentreRepository;
    }

    public function run(array $params)
    {

        $centreFindUseCase = new FindCentreUseCase($this->centreRepository);
        $entity = $centreFindUseCase->run($params['id']);

        if (null === $entity) {
            //@todo excepcions
            throw new \Exception("no s'ha trobat l'entitat");
        }

        $nom = $params['nombre'];
        $codi = $params['codi'];
        $mailCentre = $params['mailCentre'];
        $codiOficial = $params['codiOficial'];
        $color = $params['color'];
        
        $tipusCentre = $this->tipusCentreRepository->find($params['tipusCentre']);

        $address = new Address($params['carrer']);        

        $entity->update($nom, $codi, $mailCentre, $codiOficial, $color, $tipusCentre,$address);

        $entity = $this->centreRepository->update();

        return $entity;
    }
}
