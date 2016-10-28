<?php

namespace UicBundle\Application\UseCase\TipusCentre;

use UicBundle\Domain\Entity\TipusCentre\TipusCentre;

class CreateTipusCentreUseCase extends TipusCentreUseCase
{
    public function run(CreateTipusCentreRequest $createTipusCentreRequest)
    {
        $descriCat = $createTipusCentreRequest->getDescriCat();

        $this->nameExists($descriCat);

        $tipusCentre = TipusCentre::create($this->requestToArray($createTipusCentreRequest));
        
        $tipusCentre = $this->tipusCentreRepository->create($tipusCentre);


        $this->tipusCentreDataTransformer->write($tipusCentre);

        return $this->tipusCentreDataTransformer->read();
    }


    private function requestToArray(CreateTipusCentreRequest $createTipusCentreRequest)
    {
        $params = array();
        $params['descriCat'] = $createTipusCentreRequest->getDescriCat();
        $params['descriEsp'] = $createTipusCentreRequest->getDescriEsp();
        $params['descriEng'] = $createTipusCentreRequest->getDescriEng();
        return $params;
    }

}
