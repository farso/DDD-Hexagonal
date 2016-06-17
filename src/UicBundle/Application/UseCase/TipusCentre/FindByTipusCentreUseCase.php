<?php

namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Application\Contract\TipusCentreRepositoryInterface;

class FindByTipusCentreUseCase
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
     * Finds entities by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     */
	public function run(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	{		
		return $this->tipusCentreRepository->findBy($criteria, $orderBy, $limit, $offset);
	}
}
