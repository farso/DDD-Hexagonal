<?php
namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Application\Contract\TipusCentreRepositoryInterface;
use UicBundle\Application\UseCase\TipusCentre\CreateTipusCentreException;
use Doctrine\Common\Collections\Criteria;

class TipusCentreUseCase  {

    /**
    *
    * var TipusCentreRepositoryInterface
    */
    protected $tipusCentreRepository;

    public function __construct(TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->tipusCentreRepository = $tipusCentreRepository;
    }

	protected function nameExists($nombre,$id =null){

		$criteria = Criteria::create()
		    ->where(Criteria::expr()->eq("descriCat",$nombre));
		
		if (!empty($id)){
 			$criteria->andWhere(Criteria::expr()->neq("id",$id));
		}

		$centre = $this->tipusCentreRepository->matching($criteria);

	    if (count($centre) != 0) {
            throw new CreateTipusCentreException('ja existeix el nom!!',
                CreateTipusCentreException::THROW_NOM_REPETIT);
        }

	}
}
