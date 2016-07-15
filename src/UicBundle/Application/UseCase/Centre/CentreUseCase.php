<?php
namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Application\Contract\CentreRepositoryInterface;
use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
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

    public function __construct(CentreRepositoryInterface $centreRepository, TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->centreRepository = $centreRepository;
        $this->tipusCentreRepository = $tipusCentreRepository;
    }


	protected function codeExists($codi,$id =null){


		$criteria = Criteria::create()
		    ->where(Criteria::expr()->eq("codi", $codi));
		
		if (!empty($id)){
 			$criteria->andWhere(Criteria::expr()->neq("id",$id));
		}

		$centre = $this->centreRepository->matching($criteria);

        if (count($centre) != 0) {
            throw new \Exception('ja existeix el codi!!');
        }
	}

	protected function nameExists($nombre,$id =null){

		$criteria = Criteria::create()
		    ->where(Criteria::expr()->eq("nombre",$nombre));
		
		if (!empty($id)){
 			$criteria->andWhere(Criteria::expr()->neq("id",$id));
		}

		$centre = $this->centreRepository->matching($criteria);

	    if (count($centre) != 0) {
            throw new \Exception('ja existeix el nom!!');
        }

	}
}
