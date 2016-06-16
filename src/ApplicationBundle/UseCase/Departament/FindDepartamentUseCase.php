<?php

namespace ApplicationBundle\UseCase\Departament;

use ApplicationBundle\Contract\DepartamentRepositoryInterface;

class FindDepartamentUseCase
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

	public function run($id)
	{
		return $this->departamentRepository->find($id);
	}
}
