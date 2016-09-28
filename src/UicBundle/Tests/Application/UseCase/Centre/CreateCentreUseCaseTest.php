<?php
/**
 * Created by PhpStorm.
 * User: andreu
 * Date: 28/09/16
 * Time: 11:07
 */

namespace UicBundle\Tests\Application\UseCase\Centre;


use UicBundle\Application\DataTransformer\Centre\CentreObjectDataTransformer;
use UicBundle\Application\UseCase\Centre\CreateCentreRequest;
use UicBundle\Application\UseCase\Centre\CreateCentreUseCase;
use UicBundle\Infrastructure\Domain\Model\Centre\CentreRepositoryMock;
use UicBundle\Infrastructure\Domain\Model\TipusCentre\TipusCentreRepositoryMock;

class CreateCentreUseCaseTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateCentres()
    {
        $centreRepository = new CentreRepositoryMock();
        $tipusCentreRepository = new TipusCentreRepositoryMock();
        $tipusCentreRepository->fill();
        $createCentreUseCase = new CreateCentreUseCase($centreRepository, $tipusCentreRepository, new CentreObjectDataTransformer());

        $this->crearCentreArquitectura($createCentreUseCase, $tipusCentreRepository);
        $centres = $centreRepository->findAll();
        $this->assertInternalType('array', $centres);
        $this->assertEquals(count($centres), 1);

        $this->crearCentreHumanitats($createCentreUseCase, $tipusCentreRepository);
        $centres = $centreRepository->findAll();
        $this->assertInternalType('array', $centres);
        $this->assertEquals(count($centres), 2);

        $centres = $centreRepository->exists("codi", "ARQ");
        $this->assertInternalType('array', $centres);
        $this->assertEquals(count($centres), 1);
        $centre = $centres[0];
        $this->assertInstanceOf('UicBundle\Domain\Entity\Centre\Centre', $centre);
        $this->assertObjectHasAttribute('codi', $centre);
        $this->assertAttributeEquals("ARQ", "codi", $centre);
        $this->assertAttributeEquals("Escola d'Arquitectura", "nombre", $centre);
    }

    /**
     * @expectedException UicBundle\Application\UseCase\Centre\CreateCentreException
     * @expectedExceptionCode UicBundle\Application\UseCase\Centre\CreateCentreException::THROW_CODI_REPETIT
     */
    public function testCreateRepeatedCodeCentre()
    {
        $centreRepository = new CentreRepositoryMock();
        $tipusCentreRepository = new TipusCentreRepositoryMock();
        $tipusCentreRepository->fill();
        $createCentreUseCase = new CreateCentreUseCase($centreRepository, $tipusCentreRepository, new CentreObjectDataTransformer());

        $this->crearCentreHumanitats($createCentreUseCase, $tipusCentreRepository);

        $request = new CreateCentreRequest();
        $request->setCodi("HUM");
        $request->setNom("Facultat d'Humanitats 2");
        $request->setMailCentre("humanitats2@uic.es");
        $request->setColor("vermell");
        $request->setCarrer("asbsbse");
        $request->setCodiOficial("s32");
        $tipusCentres = $tipusCentreRepository->findAll();
        $request->setTipusCentre($tipusCentres[0]->getId());
        $createCentreUseCase->run($request);
    }

    /**
     * @expectedException UicBundle\Application\UseCase\Centre\CreateCentreException
     * @expectedExceptionCode UicBundle\Application\UseCase\Centre\CreateCentreException::THROW_NOM_REPETIT
     */
    public function testCreateRepeatedNameCentre()
    {
        $centreRepository = new CentreRepositoryMock();
        $tipusCentreRepository = new TipusCentreRepositoryMock();
        $tipusCentreRepository->fill();
        $createCentreUseCase = new CreateCentreUseCase($centreRepository, $tipusCentreRepository, new CentreObjectDataTransformer());

        $this->crearCentreHumanitats($createCentreUseCase, $tipusCentreRepository);

        $request = new CreateCentreRequest();
        $request->setCodi("HUM2");
        $request->setNom("Facultat d'Humanitats");
        $request->setMailCentre("humanitats2@uic.es");
        $request->setColor("vermell");
        $request->setCarrer("asbsbse");
        $request->setCodiOficial("s32");
        $tipusCentres = $tipusCentreRepository->findAll();
        $request->setTipusCentre($tipusCentres[0]->getId());
        $createCentreUseCase->run($request);
    }

    private function crearCentreArquitectura(&$createCentreUseCase, &$tipusCentreRepository)
    {
        $request = new CreateCentreRequest();
        $request->setCodi("ARQ");
        $request->setNom("Escola d'Arquitectura");
        $request->setMailCentre("esarq@uic.es");
        $request->setColor("verd");
        $request->setCarrer("blablabla");
        $request->setCodiOficial("ARQ");
        $tipusCentres = $tipusCentreRepository->findAll();
        $request->setTipusCentre($tipusCentres[0]->getId());
        $createCentreUseCase->run($request);
    }

    private function crearCentreHumanitats(&$createCentreUseCase, &$tipusCentreRepository)
    {
        $request = new CreateCentreRequest();
        $request->setCodi("HUM");
        $request->setNom("Facultat d'Humanitats");
        $request->setMailCentre("humanitats@uic.es");
        $request->setColor("blau");
        $request->setCarrer("bleblebleble");
        $request->setCodiOficial("HUM");
        $tipusCentres = $tipusCentreRepository->findAll();
        $request->setTipusCentre($tipusCentres[0]->getId());
        $createCentreUseCase->run($request);
    }
}
