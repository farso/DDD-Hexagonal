<?php

namespace UicBundle\Controller\Centre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UicBundle\Infrastructure\Form\Centre\CentreType;
use UicBundle\Application\UseCase\Centre\UpdateCentreUseCase;
use UicBundle\Application\UseCase\Centre\CreateCentreUseCase;
use UicBundle\Application\UseCase\Centre\DeleteCentreUseCase;
use UicBundle\Domain\Model\Centre\Centre;

/**
 * Centre controller.
 *
 */
class CentreController extends Controller
{
    /**
     * Lists all Centre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $centreRepository = $em->getRepository('UicBundle:Centre\Centre');
        $centres = $centreRepository->findAll();

        return $this->render('centre/index.html.twig', array(
            'centres' => $centres,
        ));
    }

    /**
     * Creates a new Centre entity.
     *
     */
    public function newAction(Request $request)
    {
        
        $newForm = $this->createForm('UicBundle\Infrastructure\Form\Centre\CentreType');
        
        $newForm->handleRequest($request);
        if ($newForm->isSubmitted() && $newForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $centreRepository = $em->getRepository('UicBundle:Centre\Centre');
            $tipusCentreRepository = $em->getRepository('UicBundle:TipusCentre\TipusCentre');
            
            $centreCreateUseCase = new CreateCentreUseCase($centreRepository, $tipusCentreRepository);
            $paramsEntity = $request->request->get($newForm->getName());

            $centre = $centreCreateUseCase->run($paramsEntity);

            return $this->redirectToRoute('centre_index');
        }

        return $this->render('centre/new.html.twig', array(
            'form' => $newForm->createView(),
        ));
    }

    /**
     * Finds and displays a Centre entity.
     *
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
     *
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
       
            $centreUpdateUseCase = new UpdateCentreUseCase($em->getRepository('UicBundle:Centre\Centre'), $em->getRepository('UicBundle:TipusCentre\TipusCentre'));

            $paramsEntity = $request->request->get($editForm->getName());
            $paramsEntity['id'] = $id;

            $centre = $centreUpdateUseCase->run($paramsEntity);

            return $this->redirectToRoute('centre_index');
        }

        return $this->render('centre/edit.html.twig', array(
            'centre' => $centre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

    }

    /**
     * Deletes a Centre entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($id);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {

            $centreDeleteUseCase = new DeleteCentreUseCase($em->getRepository('UicBundle:Centre\Centre'));
            $centreDeleteUseCase->run($id);

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
