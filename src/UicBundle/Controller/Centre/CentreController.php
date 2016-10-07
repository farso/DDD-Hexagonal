<?php

namespace UicBundle\Controller\Centre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UicBundle\Application\DataTransformer\Centre\CentreObjectDataTransformer;
use UicBundle\Application\UseCase\Centre\CreateCentreRequest;
use UicBundle\Application\UseCase\Centre\DeleteCentreRequest;
use UicBundle\Application\UseCase\Centre\UpdateCentreRequest;
use UicBundle\Application\UseCase\Centre\UpdateCentreUseCase;
use UicBundle\Application\UseCase\Centre\CreateCentreUseCase;
use UicBundle\Application\UseCase\Centre\DeleteCentreUseCase;
use UicBundle\DDD\Domain\DomainEventPublisher;
use UicBundle\DDD\Domain\PersistDomainEventSubscriber;
use UicBundle\DDD\Infrastructure\DoctrineEventStore;
use UicBundle\Domain\Entity\Centre\CentreSubscriber;

/**
 * Centre controller.
 *
 */
class CentreController extends Controller
{
    public function __construct()
    {
        DomainEventPublisher::instance()->subscribe(new CentreSubscriber());
    }


    /**
     * Lists all Centre entities.
     *
     */
    public function indexAction()
    {



        $em = $this->getDoctrine()->getManager();

        DomainEventPublisher::instance()->subscribe(new PersistDomainEventSubscriber($em->getRepository('UicBundle\DDD\Domain\StoredEvent')));

        $centreRepository = $em->getRepository('UicBundle:Centre\Centre');
        $centres = $centreRepository->findAll();

        return $this->render('centre/index.html.twig', array(
            'centres' => $centres,
        ));
    }

    /**
     * Creates a new Centre entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        
        $newForm = $this->createForm('UicBundle\Infrastructure\Form\Centre\CentreType');

        $newForm->handleRequest($request);
        if ($newForm->isSubmitted() && $newForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $centreRepository = $em->getRepository('UicBundle:Centre\Centre');
            $tipusCentreRepository = $em->getRepository('UicBundle:TipusCentre\TipusCentre');

            $centreObjectDataTransformer = new CentreObjectDataTransformer();

            $centreCreateUseCase = new CreateCentreUseCase($centreRepository, $tipusCentreRepository, $centreObjectDataTransformer);
            $paramsEntity = $request->request->get($newForm->getName());

            $createCentreRequest = new CreateCentreRequest();
            $createCentreRequest->setCarrer($paramsEntity['carrer']);
            $createCentreRequest->setCodi($paramsEntity['codi']);
            $createCentreRequest->setCodiOficial($paramsEntity['codiOficial']);
            $createCentreRequest->setColor($paramsEntity['color']);
            $createCentreRequest->setMailCentre($paramsEntity['mailCentre']);
            $createCentreRequest->setTipusCentre($paramsEntity['tipusCentre']);
            $createCentreRequest->setNom($paramsEntity['nombre']);

            $centre = $centreCreateUseCase->run($createCentreRequest);

            return $this->redirectToRoute('centre_index');
        }

        return $this->render('centre/new.html.twig', array(
            'form' => $newForm->createView(),
        ));
    }

    /**
     * Finds and displays a Centre entity.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $centreRepository = $em->getRepository('UicBundle:Centre\Centre');

        $centre = $centreRepository->find($id);

        if (!$centre) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $deleteForm = $this->createDeleteForm($centre->getId());

        return $this->render('centre/show.html.twig', array(
            'centre' => $centre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Centre entity.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $centreRepository = $em->getRepository('UicBundle:Centre\Centre');
        $centre = $centreRepository->find($id);


        if (!$centre) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        //prova @todo TRANSFORMER CAP A ARRAY PER LA VISTA
        $values = [ 'nombre' => $centre->getNombre(),
                    'codi' => $centre->getCodi(),
                    'codiOficial' => $centre->getCodiOficial(),
                    'mailCentre' => $centre->getMailCentre(),
                    'color' => $centre->getColor(),
                    'tipusCentre' => $centre->getTipusCentre(),
                    'carrer' => $centre->getAddress()->getCarrer()];


        $editForm = $this->createForm('UicBundle\Infrastructure\Form\Centre\CentreType', $values);


        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $centreObjectDataTranformer = new CentreObjectDataTransformer();
            $centreUpdateUseCase = new UpdateCentreUseCase($em->getRepository('UicBundle:Centre\Centre'), $em->getRepository('UicBundle:TipusCentre\TipusCentre'), $centreObjectDataTranformer);

            $paramsEntity = $request->request->get($editForm->getName());

            $updateCentreRequest = new UpdateCentreRequest();
            $updateCentreRequest->setId($id);
            $updateCentreRequest->setCarrer($paramsEntity['carrer']);
            $updateCentreRequest->setCodi($paramsEntity['codi']);
            $updateCentreRequest->setCodiOficial($paramsEntity['codiOficial']);
            $updateCentreRequest->setColor($paramsEntity['color']);
            $updateCentreRequest->setMailCentre($paramsEntity['mailCentre']);
            $updateCentreRequest->setTipusCentre($paramsEntity['tipusCentre']);
            $updateCentreRequest->setNom($paramsEntity['nombre']);
            $centre = $centreUpdateUseCase->run($updateCentreRequest);

            return $this->redirectToRoute('centre_index');
        }

        return $this->render('centre/edit.html.twig', array(
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

    }

    /**
     * Deletes a Centre entity.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($id);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {

            $centreDeleteUseCase = new DeleteCentreUseCase($em->getRepository('UicBundle:Centre\Centre'));
            $deleteCentreRequest = new DeleteCentreRequest();
            $deleteCentreRequest->setId($id);
            $centreDeleteUseCase->run($deleteCentreRequest);

        }

        return $this->redirectToRoute('centre_index');
    }


    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('centre_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
