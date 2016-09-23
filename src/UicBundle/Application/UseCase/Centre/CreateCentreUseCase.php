<?php

namespace UicBundle\Application\UseCase\Centre;

use UicBundle\Domain\Entity\Centre\Address;
use UicBundle\Application\Factory\CentreFactory;

class CreateCentreUseCase extends CentreUseCase
{
    public function run(CreateCentreRequest $request)
    {
        $this->codeExists($request->getCodi());
        $this->nameExists($request->getNom());

        $tipusCentre = $this->tipusCentreRepository->find($request->getTipusCentre());

        $address = new Address($request->getCarrer());

        $params = $this->requestToArray($request, $tipusCentre, $address);

        $centreFactory = new CentreFactory();
        $centre = $centreFactory->create($params);
        
        $this->centreRepository->create($centre);

        //transformer -> write($centre)
        $this->centreDataTransformer->write($centre);

        return $this->centreDataTransformer->read();
    }

    /**
     * @param CreateCentreRequest $request
     * @param $tipusCentre
     * @param $params
     * @param $address
     * @return mixed
     */
    private function requestToArray(CreateCentreRequest $request, $tipusCentre, $address)
    {
        $params = array();
        $params['tipusCentre'] = $tipusCentre;
        $params['address'] = $address;
        $params['nombre'] = $request->getNom();
        $params['codi'] = $request->getCodi();
        $params['mailCentre'] = $request->getMailCentre();
        $params['codiOficial'] = $request->getCodiOficial();
        $params['color'] = $request->getColor();
        return $params;
    }
}
