<?php

namespace ApplicationBundle\UseCase\Departament;

use ApplicationBundle\Contract\DepartamentRepositoryInterface;

class UpdateDepartamentUseCase
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

	public function run(array $params)
	{

		$departamentFindUseCase = new FindDepartamentUseCase($this->departamentRepository);
        $entity = $departamentFindUseCase->run($params['id']); 

        if (null === $entity) {
        	//@todo excepcions
        	throw new \Exception("no s'ha trobat l'entitat");
        }

        	//@todo validació de variables per lògica complexa (que el nom sigui la composició de 3 + 2, ...)
        	//   les validacions d'entitat haurien d'anar repetides a tots els uses cases o no?
        	//   

        $entity = $this->departamentRepository->update($params); 

       	return $entity;
	}
}
