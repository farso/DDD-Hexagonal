<?php
namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
use UicBundle\Application\DataTransformer\Centre\CentreDataTransformer;
use UicBundle\Application\UseCase\Centre\CreateCentreException;
use Doctrine\Common\Collections\Criteria;

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


	protected function codeExists($codi,$id =null){


		$criteria = Criteria::create()
		    ->where(Criteria::expr()->eq("codi", $codi));
		
		if (!empty($id)){
 			$criteria->andWhere(Criteria::expr()->neq("id",$id));
		}

		$centre = $this->centreRepository->matching($criteria);

        if (count($centre) != 0) {
            throw new CreateCentreException('ja existeix el codi!!', 
            	CreateCentreException::THROW_CODI_REPETIT);
        }
	}

	protected function nameExists($nombre,$id =null){

		$criteria = Criteria::create()
		    ->where(Criteria::expr()->eq("nombre",$nombre));
		
		if (!empty($id)){
 			$criteria->andWhere(Criteria::expr()->neq("id",$id));
		}

		// TODO Observació aros: matching() és funció pròpia de Doctrine?
        // Hauriem de posar una capa per sobre per desconnectarnos del framework
		$centre = $this->centreRepository->matching($criteria);

	    if (count($centre) != 0) {
            throw new CreateCentreException('ja existeix el nom!!', 
            	CreateCentreException::THROW_NOM_REPETIT);
        }

	}
}
