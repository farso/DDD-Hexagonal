<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\UseCase\Centre\CentreUseCase;

class FindAllCentreUseCase extends CentreUseCase
{
	public function __construct(CentreRepositoryInterface $centreRepository)
	{
		$this->centreRepository = $centreRepository;
	}

	public function run()
	{
		return $this->centreRepository->findAll();
	}
}
