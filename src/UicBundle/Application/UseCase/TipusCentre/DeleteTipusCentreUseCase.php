<?php

namespace UicBundle\Application\UseCase\TipusCentre;


use UicBundle\Application\Contract\TipusCentreRepositoryInterface;

class DeleteTipusCentreUseCase extends TipusCentreUseCase
{

    public function __construct(TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->tipusCentreRepository = $tipusCentreRepository;
    }

    public function run(DeleteTipusCentreRequest $request)
    {
        $entity = $this->tipusCentreRepository->find($request->getId());

        if (!$entity) {
            throw new DeleteTipusCentreException('Unable to find TipusCentre Entity');
        }

        $this->tipusCentreRepository->delete($entity);
    }
}
