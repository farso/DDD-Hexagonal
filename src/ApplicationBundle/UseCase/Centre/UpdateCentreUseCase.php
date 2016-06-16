<?php

namespace ApplicationBundle\UseCase\Centre;

use ApplicationBundle\Contract\CentreRepositoryInterface;

class UpdateCentreUseCase
{
    /**
    *
    * var CentreRepositoryInterface
    */
    private $centreRepository;

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centreRepository = $centreRepository;
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

        $entity->update($nom, $codi, $mailCentre, $codiOficial, $color);


        $entity = $this->centreRepository->update($params);

        return $entity;
    }
}
