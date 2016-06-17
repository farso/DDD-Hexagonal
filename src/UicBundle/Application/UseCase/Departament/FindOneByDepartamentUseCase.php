<?php

namespace UicBundle\Application\UseCase\Departament;

use UicBundle\Application\Contract\DepartamentRepositoryInterface;

class FindOneByDepartamentUseCase
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
     * FindOnes entities by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @return array The objects.
     */
	public function run(array $criteria, array $orderBy = null)
	{		
		return $this->departamentRepository->findOneBy($criteria, $orderBy);
	}
}
