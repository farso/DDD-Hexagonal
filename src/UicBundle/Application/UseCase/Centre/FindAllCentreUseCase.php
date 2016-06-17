<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;

class FindAllCentreUseCase
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

	public function run()
	{
		return $this->centreRepository->findAll();
	}
}
