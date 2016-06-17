<?php

namespace UicBundle\Application\UseCase\Departament;

use UicBundle\Application\Contract\DepartamentRepositoryInterface;

class FindByDepartamentUseCase
{
	/**
	*
	* var DepartamentRepositoryInterface
	*/
	private $departamentRepository;

	public function __construct(DepartamentRepositoryInterface $departamentRepository)
	{
		$this->departamentRepository = $departamentRepository;
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
		return $this->departamentRepository->findBy($criteria, $orderBy, $limit, $offset);
	}
}
