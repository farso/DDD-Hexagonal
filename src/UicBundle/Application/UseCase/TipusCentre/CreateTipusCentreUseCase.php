<?php

namespace UicBundle\Application\UseCase\TipusCentre;


use UicBundle\Application\Factory\TipusCentreFactory;

class CreateTipusCentreUseCase extends TipusCentreUseCase
{
    public function run(CreateTipusCentreRequest $createTipusCentreRequest)
    {
        $descriCat = $createTipusCentreRequest->getDescriCat();

        $this->nameExists($descriCat);

        $tipusCentreFactory = new TipusCentreFactory();
        $tipusCentre = $tipusCentreFactory->create($this->requestToArray($createTipusCentreRequest));
        
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
