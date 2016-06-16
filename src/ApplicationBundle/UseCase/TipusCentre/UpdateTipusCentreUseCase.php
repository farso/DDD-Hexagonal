<?php

namespace ApplicationBundle\UseCase\TipusCentre;

use ApplicationBundle\Contract\TipusCentreRepositoryInterface;

class UpdateTipusCentreUseCase
{
    /**
    *
    * var TipusCentreRepositoryInterface
    */
    private $tipusCentreRepository;

    public function __construct(TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->tipusCentreRepository = $tipusCentreRepository;
    }

    public function run(array $params)
    {

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($this->tipusCentreRepository);
        $tipusCentre = $tipusCentreFindUseCase->run($params['id']);

        if (null === $tipusCentre) {
            //@todo excepcions
            throw new \Exception("no s'ha trobat l'entitat");
        }

        $descriCat = $params['descriCat'];
        $descriEng = $params['descriEng'];
        $descriEsp = $params['descriEsp'];

        $tipusCentre->update($descriCat, $descriEsp, $descriEng);
        
        $tipusCentre = $this->tipusCentreRepository->update($params);

        return $tipusCentre;
    }
}
