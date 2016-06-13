<?php

namespace ApplicationBundle\UseCase\Departament;

use ApplicationBundle\Contract\DepartamentRepositoryInterface;

class FindAllDepartamentUseCase
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

	public function run()
	{
		return $this->departamentRepository->findAll();
	}
}
