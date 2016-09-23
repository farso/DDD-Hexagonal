<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use \UicBundle\Application\UseCase\Centre\CreateCentreUseCase;
use \UicBundle\Infrastructure\Domain\Model\TipusCentre\TipusCentreRepositoryMock;
use \UicBundle\Infrastructure\Domain\Model\Centre\CentreRepositoryMock;
use \UicBundle\Application\UseCase\Centre\CreateCentreException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements SnippetAcceptingContext
{
    private $centreRepository;
    private $tipusCentreRepository;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->centreRepository = new CentreRepositoryMock();
        $this->tipusCentreRepository = new TipusCentreRepositoryMock();
        $this->tipusCentreRepository->fill();
    }

    /**
     * @Given there are no centres created
     */
    public function thereAreNoCentresCreated()
    {
        $this->centreRepository->removeAll();
    }

    /**
     * @When I create a new centre with code :code and name :name
     */
    public function iCreateANewCentreWithCodeAndName($code, $name)
    {
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository);
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $createCentreUseCase->run(
            array('codi' => $code, 'nombre' => $name, 'tipusCentre' => $tipusCentres[0]->getId(), 'carrer' => 'aaaa', 'codiOficial' => 'b83s', 'color' => 'blau', 'mailCentre' => 'ass@sfs.es')
        );
    }

    /**
     * @When I create a new centre with repeated code :code and name :name
     */
    public function iCreateANewCentreWithRepeatedCodeAndName($code, $name)
    {
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository);
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $createCentreUseCase->run(
            array('codi' => $code, 'nombre' => $name, 'tipusCentre' => $tipusCentres[0]->getId(), 'carrer' => 'aaaa', 'codiOficial' => 'b83s', 'color' => 'blau', 'mailCentre' => 'ass@sfs.es')
        );
        PHPUnit_Framework_Assert::expectException(CreateCentreException::class);
        PHPUnit_Framework_Assert::expectExceptionCode(CreateCentreException::THROW_CODI_REPETIT);
    }

    /**
     * @When I create a new centre with code :code and repeated name :name
     */
    public function iCreateANewCentreWithCodeAndRepeatedName($code, $name)
    {
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository);
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $createCentreUseCase->run(
            array('codi' => $code, 'nombre' => $name, 'tipusCentre' => $tipusCentres[0]->getId(), 'carrer' => 'aaaa', 'codiOficial' => 'b83s', 'color' => 'blau', 'mailCentre' => 'ass@sfs.es')
        );
        PHPUnit_Framework_Assert::expectException(CreateCentreException::class);
        PHPUnit_Framework_Assert::expectExceptionCode(CreateCentreException::THROW_NOM_REPETIT);
    }

    /**
     * @Then I should see :message
     */
    public function iShouldSee($message)
    {
        PHPUnit_Framework_Assert::assertEquals($message, "Centre created correctly");
    }

    /**
     * @Then there should be :count centre(s) in the list
     */
    public function thereShouldBeCentreSInTheList($count)
    {
        PHPUnit_Framework_Assert::assertEquals(count($this->centreRepository->findAll()), $count);
    }

    /**
     * @Given one centre with code :code
     */
    public function oneCentreWithCode($code)
    {
        $this->centreRepository->removeAll();
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository);
        $createCentreUseCase->run(array('codi' => $code, 'nombre' => 'indefinit'));
    }

    /**
     * @Given one centre with name :name
     */
    public function oneCentreWithName($name)
    {
        $this->centreRepository->removeAll();
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository);
        $createCentreUseCase->run(array('codi' => 'OOO', 'nombre' => $name));
    }
}
