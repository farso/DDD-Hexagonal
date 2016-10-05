<?php

namespace UicBundle\Application\UseCase\TipusCentre;

class UpdateTipusCentreUseCase extends TipusCentreUseCase
{

    public function run(UpdateTipusCentreRequest $request)
    {

        $entity = $this->tipusCentreRepository->find($request->getId());

        if (!$entity) {
            throw new UpdateTipusCentreException('Unable to find TipusCentre Entity');
        }
        $this->nameExists($request->getDescriCat());

        $descriCat = $request->getDescriCat();
        $descriEng = $request->getDescriEng();
        $descriEsp = $request->getDescriEsp();

        $entity->update($descriCat, $descriEsp, $descriEng);
        
        $tipusCentre = $this->tipusCentreRepository->update();

        return $tipusCentre;
    }
}
