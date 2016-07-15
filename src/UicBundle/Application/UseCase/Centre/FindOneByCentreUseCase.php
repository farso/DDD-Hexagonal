<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\UseCase\Centre\CentreUseCase;

class FindOneByCentreUseCase extends CentreUseCase
{
	public function __construct(CentreRepositoryInterface $centreRepository)
	{
		$this->centreRepository = $centreRepository;
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
		return $this->centreRepository->findOneBy($criteria, $orderBy);
	}
}
