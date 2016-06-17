<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;

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
