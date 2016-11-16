<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Domain\Entity\Centre\Address;

class UpdateCentreUseCase extends CentreUseCase
{
    public function run(UpdateCentreRequest $request)
    {
        $entity = $this->centreRepository->find($request->getId());

        if (!$entity) {
            throw new DeleteCentreException('Unable to find Centre entity.', 
                UpdateCentreException::THROW_NOT_FOUND);
        }

        $this->codeExists($request->getCodi(),$request->getId());
        $this->nameExists($request->getNom(),$request->getId());


        $tipusCentre = $this->tipusCentreRepository->find($request->getTipusCentre());
        $address = new Address($request->getCarrer());

        $nom = $request->getNom();
        $codi = $request->getCodi();
        $mailCentre= $request->getMailCentre();
        $codiOficial = $request->getCodiOficial();
        $color = $request->getColor();

        $entity->update($nom, $codi, $mailCentre, $codiOficial, $color, $tipusCentre,$address);

        $this->centreRepository->update();

        $this->centreDataTransformer->write($entity);

        return $this->centreDataTransformer->read();
    }
}
