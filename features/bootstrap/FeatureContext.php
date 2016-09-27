<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
//use Behat\Gherkin\Node\PyStringNode;
//use Behat\Gherkin\Node\TableNode;
use \UicBundle\Application\UseCase\Centre\CreateCentreUseCase;
use \UicBundle\Infrastructure\Domain\Model\TipusCentre\TipusCentreRepositoryMock;
use \UicBundle\Infrastructure\Domain\Model\Centre\CentreRepositoryMock;
use \UicBundle\Application\UseCase\Centre\CreateCentreException;
use \UicBundle\Application\DataTransformer\Centre\CentreObjectDataTransformer;
use \UicBundle\Application\UseCase\Centre\CreateCentreRequest;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements SnippetAcceptingContext
{
    private $centreRepository;
    private $tipusCentreRepository;
    private $centreDataTransformer;
    private $message;

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
        $this->centreDataTransformer = new CentreObjectDataTransformer();
        $this->message = '';
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
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository, $this->centreDataTransformer);
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $request = new CreateCentreRequest();
        $request->setCodi($code);
        $request->setNom($name);
        $request->setTipusCentre($tipusCentres[0]->getId());
        $request->setCarrer('carrer');
        $request->setCodiOficial('b832s');
        $request->setColor('blau');
        $request->setMailCentre('ass@ssfg.es');
        $createCentreUseCase->run($request);
    }

    /**
     * @When I create a new centre with repeated code :code and name :name
     */
    public function iCreateANewCentreWithRepeatedCodeAndName($code, $name)
    {
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository, $this->centreDataTransformer);
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $request = new CreateCentreRequest();
        $request->setCodi($code);
        $request->setNom($name);
        $request->setTipusCentre($tipusCentres[0]->getId());
        $request->setCarrer('carrer');
        $request->setCodiOficial('b832s');
        $request->setColor('blau');
        $request->setMailCentre('ass@ssfg.es');

        try {
            $createCentreUseCase->run($request);
        }
        catch (CreateCentreException $exception) {
            $this->message = $exception->getMessage();
        }
    }

    /**
     * @When I create a new centre with code :code and repeated name :name
     */
    public function iCreateANewCentreWithCodeAndRepeatedName($code, $name)
    {
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository, $this->centreDataTransformer);
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $request = new CreateCentreRequest();
        $request->setCodi($code);
        $request->setNom($name);
        $request->setTipusCentre($tipusCentres[0]->getId());
        $request->setCarrer('carrer');
        $request->setCodiOficial('b832s');
        $request->setColor('blau');
        $request->setMailCentre('ass@ssfg.es');

        try {
            $createCentreUseCase->run($request);
        }
        catch (CreateCentreException $exception) {
            $this->message = $exception->getMessage();
        }
    }

    /**
     * @Then I should see :message
     */
    public function iShouldSee($message)
    {
        assertEquals($message, $this->message);
    }

    /**
     * @Then there should be :count centre(s) in the list
     */
    public function thereShouldBeCentresInTheList($count)
    {
        assertEquals(count($this->centreRepository->findAll()), $count);
    }

    /**
     * @Given one centre with code :code
     */
    public function oneCentreWithCode($code)
    {
        $this->centreRepository->removeAll();
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository, $this->centreDataTransformer);
        $request = new CreateCentreRequest();
        $request->setCodi($code);
        $request->setNom('oooooo');
        $request->setTipusCentre($tipusCentres[0]->getId());
        $request->setCarrer('carrer');
        $request->setCodiOficial('b832s');
        $request->setColor('blau');
        $request->setMailCentre('ass@ssfg.es');
        $createCentreUseCase->run($request);
    }

    /**
     * @Given one centre with name :name
     */
    public function oneCentreWithName($name)
    {
        $this->centreRepository->removeAll();
        $tipusCentres = $this->tipusCentreRepository->findAll();
        $createCentreUseCase = new CreateCentreUseCase($this->centreRepository, $this->tipusCentreRepository, $this->centreDataTransformer);
        $request = new CreateCentreRequest();
        $request->setCodi('OOO');
        $request->setNom($name);
        $request->setTipusCentre($tipusCentres[0]->getId());
        $request->setCarrer('carrer');
        $request->setCodiOficial('b832s');
        $request->setColor('blau');
        $request->setMailCentre('ass@ssfg.es');
        $createCentreUseCase->run($request);
    }
}
