<?php

namespace ApplicationBundle\UseCase\TipusCentre;

use ApplicationBundle\Contract\TipusCentreRepositoryInterface;

class FindOneByTipusCentreUseCase
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

	/**
     * FindOnes entities by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @return array The objects.
     */
	public function run(array $criteria, array $orderBy = null)
	{		
		return $this->tipusCentreRepository->findOneBy($criteria, $orderBy);
	}
}
