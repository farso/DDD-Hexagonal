<?php

namespace ApplicationBundle\UseCase\Centre;

use ApplicationBundle\Contract\CentreRepositoryInterface;

class FindCentreUseCase
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
		return $this->centreRepository->find($id);
	}
}
