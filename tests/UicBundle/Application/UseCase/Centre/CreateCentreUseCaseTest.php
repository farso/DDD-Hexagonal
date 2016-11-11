<?php

namespace Tests\UicBundle\Application\UseCase\Centre;
use UicBundle\Application\DataTransformer\Centre\CentreObjectDataTransformer;
use UicBundle\Application\UseCase\Centre\CreateCentreException;
use UicBundle\Application\UseCase\Centre\CreateCentreRequest;
use UicBundle\Application\UseCase\Centre\CreateCentreUseCase;
use UicBundle\Domain\Entity\Centre\Centre;
use UicBundle\Domain\Entity\TipusCentre\TipusCentre;
use UicBundle\Infrastructure\Domain\Model\Centre\CentreRepositoryMock;
use UicBundle\Infrastructure\Domain\Model\TipusCentre\TipusCentreRepositoryMock;


/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 10/11/16
 * Time: 16:07
 */
class CreateCentreUseCaseTest extends \PHPUnit_Framework_TestCase
{

    private $centreRepositoryMock;
    private $tipusCentreRepositoryMock;
    private $centreDataTransformer;
    private $tipusCentre;

    public function setUp()
    {
        $this->centreRepositoryMock = new CentreRepositoryMock();
        $this->tipusCentreRepositoryMock = new TipusCentreRepositoryMock();
        $this->centreDataTransformer = new CentreObjectDataTransformer();

        $this->tipusCentre = $this->tipusCentreRepositoryMock->getFirstTipusCentre();
    }

    /**
     * @test
     */
    public function createCentre()
    {
        $useCase = new CreateCentreUseCase($this->centreRepositoryMock, $this->tipusCentreRepositoryMock, $this->centreDataTransformer);

        $request = new CreateCentreRequest();

        $request->setCarrer('carrer');
        $request->setCodi('codi');
        $request->setCodiOficial('codi oficial');
        $request->setColor('color');
        $request->setMailCentre('mail');
        $request->setNom('nom');
        $request->setTipusCentre($this->tipusCentre->getId());

        $centre = $useCase->run($request);

        $this->assertInstanceOf(Centre::class, $centre);

    }

    /**
     * @test
     * @expectedException UicBundle\Application\UseCase\Centre\CreateCentreException
     */
    public function itShouldntSaveTwoCentresWithTheSameName()
    {

        $useCase = new CreateCentreUseCase($this->centreRepositoryMock, $this->tipusCentreRepositoryMock, $this->centreDataTransformer);

        $request = new CreateCentreRequest();
        $request->setCarrer('carrer');
        $request->setCodi('codi');
        $request->setCodiOficial('codi oficial');
        $request->setColor('color');
        $request->setMailCentre('mail');
        $request->setNom('nom');
        $request->setTipusCentre($this->tipusCentre->getId());

        $centre = $useCase->run($request);


        $request = new CreateCentreRequest();
        $request->setCarrer('carrer 2');
        $request->setCodi('codi 2');
        $request->setCodiOficial('codi oficial 2');
        $request->setColor('color 2');
        $request->setMailCentre('mail 2');
        $request->setNom('nom');
        $request->setTipusCentre($this->tipusCentre->getId());

        $centre2 = $useCase->run($request);


    }

}