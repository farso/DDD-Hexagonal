<?php

namespace UicBundle\Application\UseCase\TipusCentre;




class DeleteTipusCentreUseCase extends TipusCentreUseCase
{
    public function run(DeleteTipusCentreRequest $request)
    {
        $entity = $this->tipusCentreRepository->find($request->getId());

        if (!$entity) {
            throw new DeleteTipusCentreException('Unable to find TipusCentre Entity');
        }

        $this->tipusCentreRepository->delete($entity);
    }
}
