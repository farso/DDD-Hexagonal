<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;

class DeleteCentreUseCase
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

    public function run($id)
    {
        $centreFindUseCase = new FindCentreUseCase($this->centreRepository);
        $entity = $centreFindUseCase->run($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $this->centreRepository->delete($entity);
    }
}