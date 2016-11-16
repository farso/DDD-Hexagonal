<?php
namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
use UicBundle\Application\DataTransformer\Centre\CentreDataTransformer;

class CentreUseCase  {
	
	 /**
    *
    * var CentreRepositoryInterface
    */
    protected $centreRepository;

    /**
    *
    * var TipusCentreRepositoryInterface
    */
    protected $tipusCentreRepository;

    protected $centreDataTransformer;

    public function __construct(CentreRepositoryInterface $centreRepository, TipusCentreRepositoryInterface $tipusCentreRepository, CentreDataTransformer $centreDataTransformer)
    {
        $this->centreRepository = $centreRepository;
        $this->tipusCentreRepository = $tipusCentreRepository;
        $this->centreDataTransformer = $centreDataTransformer;
    }

	protected function codeExists($codi, $id = null)
    {
		$centre = $this->centreRepository->exists("codi", $codi, $id);

        if (count($centre) != 0) {
            throw new CreateCentreException('ja existeix el codi!!', 
            	CreateCentreException::THROW_CODI_REPETIT);
        }
	}

	protected function nameExists($nombre, $id = null)
    {
        $centre = $this->centreRepository->exists("nombre", $nombre, $id);

	    if (count($centre) != 0) {
            throw new CreateCentreException('ja existeix el nom!!', 
            	CreateCentreException::THROW_NOM_REPETIT);
        }

	}
}
