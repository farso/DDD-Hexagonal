<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
use UicBundle\Domain\Entity\Centre\Address;
use UicBundle\Application\UseCase\Centre\CentreUseCase;
use UicBundle\Application\UseCase\Centre\UpdateCentreException;

class UpdateCentreUseCase extends CentreUseCase
{
    public function run(array $params)
    {
        $entity = $this->centreRepository->find($params['id']);

        if (!$entity) {
            throw new DeleteCentreException('Unable to find Centre entity.', 
                UpdateCentreException::THROW_NOT_FOUND);
        }

        $this->codeExists($params['codi'],$params['id']);
        $this->nameExists($params['nombre'],$params['id']);

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
