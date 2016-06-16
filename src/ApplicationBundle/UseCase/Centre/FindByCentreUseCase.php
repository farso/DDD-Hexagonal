<?php

namespace ApplicationBundle\UseCase\Centre;

use ApplicationBundle\Contract\CentreRepositoryInterface;

class FindByCentreUseCase
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
		return $this->centreRepository->findBy($criteria, $orderBy, $limit, $offset);
	}
}
