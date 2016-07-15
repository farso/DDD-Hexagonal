<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\UseCase\Centre\CentreUseCase;

class FindCentreUseCase extends CentreUseCase
{
	
	public function __construct(CentreRepositoryInterface $centreRepository)
	{
		$this->centreRepository = $centreRepository;
	}

	public function run($id)
	{
		$entity = $this->centreRepository->find($id);
		
		if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

		return $entity;
	}
}
