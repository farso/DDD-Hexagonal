<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\UseCase\Centre\CentreUseCase;

class DeleteCentreUseCase extends CentreUseCase
{

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centreRepository = $centreRepository;
    }

    public function run($id)
    {
        $centreFindUseCase = new FindCentreUseCase($this->centreRepository);
        $entity = $centreFindUseCase->run($id);
        $this->centreRepository->delete($entity);
    }
}
