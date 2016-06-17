<?php

namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Application\Contract\TipusCentreRepositoryInterface;

class FindTipusCentreUseCase
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
		return $this->tipusCentreRepository->find($id);
	}
}
