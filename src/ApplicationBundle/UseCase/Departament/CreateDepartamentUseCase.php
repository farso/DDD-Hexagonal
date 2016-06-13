<?php

namespace ApplicationBundle\UseCase\Departament;

use ApplicationBundle\Contract\DepartamentRepositoryInterface;
use DomainBundle\Entity\Departament\Departament;
use ApplicationBundle\UseCase\Departament\FindOneByDepartamentUseCase;

class CreateDepartamentUseCase
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
		//@todo FALTA SABER COM FUNCIONA EL FINDBY PER FER-HO SERVIR CORRECTAMENT
		$departamentFindOneByUseCase = new FindOneByDepartamentUseCase($this->departamentRepository);

		$entity = $departamentFindOneByUseCase->run(array("nombre"=>$params['nombre'])); 

        if (null !== $entity) {
        	throw new \Exception('ja existeix el nom!!');
        }

        	//@todo validació de variables per lògica complexa (que el nom sigui la composició de 3 + 2, ...)
        	//   les validacions d'entitat haurien d'anar repetides a tots els uses cases o no?
        	//   

       	 
       	$entity = $this->departamentRepository->create($params); 

       	return $entity;
	}
}
