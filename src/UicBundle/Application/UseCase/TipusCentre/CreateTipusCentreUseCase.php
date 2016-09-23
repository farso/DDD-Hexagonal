<?php

namespace UicBundle\Application\UseCase\TipusCentre;


use UicBundle\Application\Factory\TipusCentreFactory;

class CreateTipusCentreUseCase extends TipusCentreUseCase
{
    public function run(array $params)
    {
        $this->nameExists($params['descriCat']);

        $tipusCentreFactory = new TipusCentreFactory();
        $tipusCentre = $tipusCentreFactory->create($params);
        
        $tipusCentre = $this->tipusCentreRepository->create($tipusCentre);

        return $tipusCentre;
    }
}
