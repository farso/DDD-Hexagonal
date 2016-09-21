<?php

namespace UicBundle\Application\UseCase\TipusCentre;




class DeleteTipusCentreUseCase extends TipusCentreUseCase
{
    public function run($id)
    {
        $entity = $this->tipusCentreRepository->find($id);

        if (!$entity) {
            throw new DeleteTipusCentreException('Unable to find TipusCentre Entity');
        }

        $this->tipusCentreRepository->delete($entity);
    }
}
