<?php

namespace UicBundle\Application\UseCase\Departament;

use UicBundle\Application\Contract\DepartamentRepositoryInterface;

class DeleteDepartamentUseCase
{
	/**
	*
	* var dDepartamentRepositoryInterface
	*/
	private $departamentRepository;

	public function __construct(DepartamentRepositoryInterface $departamentRepository)
	{
		$this->departamentRepository = $departamentRepository;
	}

	public function run($id)
	{
		$departamentFindUseCase = new FindDepartamentUseCase($this->departamentRepository);
        $entity = $departamentFindUseCase->run($id); 

        if (!$entity) {
        	throw $this->createNotFoundException('Unable to find Departament entity.');
        }

		$this->departamentRepository->delete($id);
	}
}
