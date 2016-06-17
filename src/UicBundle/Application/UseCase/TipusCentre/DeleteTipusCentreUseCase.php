<?php

namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Application\Contract\TipusCentreRepositoryInterface;

class DeleteTipusCentreUseCase
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

    public function run($id)
    {
        $tipusCentreFindUseCase = new FindTipusCentreUseCase($this->tipusCentreRepository);
        $tipusCentre = $tipusCentreFindUseCase->run($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $this->tipusCentreRepository->delete($tipusCentre);
    }
}
