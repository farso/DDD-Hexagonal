<?php

namespace UicBundle\Application\UseCase\TipusCentre;

class UpdateTipusCentreUseCase extends TipusCentreUseCase
{

    public function run(array $params)
    {

        $entity = $this->tipusCentreRepository->find($params['id']);

        if (!$entity) {
            throw new UpdateTipusCentreException('Unable to find TipusCentre Entity');
        }
        $this->nameExists($params['descriCat']);

        $descriCat = $params['descriCat'];
        $descriEng = $params['descriEng'];
        $descriEsp = $params['descriEsp'];

        $entity->update($descriCat, $descriEsp, $descriEng);
        
        $tipusCentre = $this->tipusCentreRepository->update();

        return $tipusCentre;
    }
}
