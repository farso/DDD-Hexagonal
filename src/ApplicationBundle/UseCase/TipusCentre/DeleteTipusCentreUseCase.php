<?php

namespace ApplicationBundle\UseCase\TipusCentre;

use ApplicationBundle\Contract\TipusCentreRepositoryInterface;

class DeleteTipusCentreUseCase
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
		$tipusCentreFindUseCase = new FindTipusCentreUseCase($this->tipusCentreRepository);
        $entity = $tipusCentreFindUseCase->run($id); 

        if (!$entity) {
        	throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

		$this->tipusCentreRepository->delete($id);
	}
}
