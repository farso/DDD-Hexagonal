<?php

namespace ApplicationBundle\UseCase\Centre;

use ApplicationBundle\Contract\CentreRepositoryInterface;

class UpdateCentreUseCase
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

	public function run(array $params)
	{

		$centreFindUseCase = new FindCentreUseCase($this->centreRepository);
        $entity = $centreFindUseCase->run($params['id']); 

        if (null === $entity) {
        	//@todo excepcions
        	throw new \Exception("no s'ha trobat l'entitat");
        }

        	//@todo validació de variables per lògica complexa (que el nom sigui la composició de 3 + 2, ...)
        	//   les validacions d'entitat haurien d'anar repetides a tots els uses cases o no?
        	//   

        $entity = $this->centreRepository->update($params); 

       	return $entity;
	}
}
