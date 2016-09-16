<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\UseCase\Centre\CentreUseCase;
use UicBundle\Application\UseCase\Centre\DeleteCentreException;

class DeleteCentreUseCase extends CentreUseCase
{

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centreRepository = $centreRepository;
    }

    public function run($id)
    {
        $entity = $this->centreRepository->find($id);

        if (!$entity) {
            throw new DeleteCentreException('Unable to find Centre entity.', 
                DeleteCentreException::THROW_NOT_FOUND);
        }


        $this->centreRepository->delete($entity);
    }
}
