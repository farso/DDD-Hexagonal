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

    public function run(DeleteCentreRequest $request)
    {
        $entity = $this->centreRepository->find($request->getId());

        if (!$entity) {
            throw new DeleteCentreException('Unable to find Centre entity.', 
                DeleteCentreException::THROW_NOT_FOUND);
        }


        $this->centreRepository->delete($entity);
    }
}
