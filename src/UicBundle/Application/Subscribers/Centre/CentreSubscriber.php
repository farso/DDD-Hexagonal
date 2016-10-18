<?php
/**
 * Created by PhpStorm.
 * User: jmanrique
 * Date: 05/10/16
 * Time: 14:00
 */

namespace UicBundle\Application\Subscribers\Centre;

use uic\ddd\Domain\DomainEvent;
use uic\ddd\Application\DomainEventSubscriber;
use UicBundle\Domain\Entity\Centre\CentreCreated;

// prova ***
use UicBundle\Application\DataTransformer\TipusCentre\TipusCentreObjectDataTransformer;
use UicBundle\Application\UseCase\TipusCentre\UpdateTipusCentreUseCase;
use UicBundle\Application\UseCase\TipusCentre\UpdateTipusCentreRequest;
use UicBundle\Application\Contract\TipusCentreRepositoryInterface;

class CentreSubscriber implements DomainEventSubscriber
{
    // prova ***
    private $tipusCentreRepository;

    // prova ***
    public function __construct(TipusCentreRepositoryInterface $tipusCentreRepository)
    {
        $this->tipusCentreRepository = $tipusCentreRepository;
    }

    public function handle($aDomainEvent)
    {
        //@todo si es deixa el die, surt el xivato però la transacció no fa el commit
        // trenca la teoria de 1 transacció -> 1 aggregate

        echo ' handle de '.get_class($aDomainEvent).' occurred on '. $aDomainEvent->occurredOn()->getTimestamp();


        // prova *** de cridar un use case des d'un subscriber:
        $tipusCentreObjectDataTransformer = new TipusCentreObjectDataTransformer();
        $tipusCentreUpdateUseCase = new UpdateTipusCentreUseCase($this->tipusCentreRepository, $tipusCentreObjectDataTransformer);

        $updateTipusCentreRequest = new UpdateTipusCentreRequest();
        $updateTipusCentreRequest->setId('055db2bc-f0c3-467b-9063-0fdb58194034');
        $updateTipusCentreRequest->setDescriCat('provaaaa');
        

        $tipusCentre = $tipusCentreUpdateUseCase->run($updateTipusCentreRequest);

    }


    public function isSubscribedTo($aDomainEvent)
    {
        return $aDomainEvent instanceof CentreCreated;
    }

}