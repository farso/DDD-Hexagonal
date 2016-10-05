<?php

namespace UicBundle\Controller\TipusCentre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UicBundle\Application\DataTransformer\TipusCentre\TipusCentreObjectDataTransformer;
use UicBundle\Application\UseCase\TipusCentre\CreateTipusCentreRequest;
use UicBundle\Application\UseCase\TipusCentre\CreateTipusCentreUseCase;
use UicBundle\Application\UseCase\TipusCentre\DeleteTipusCentreRequest;
use UicBundle\Application\UseCase\TipusCentre\UpdateTipusCentreRequest;
use UicBundle\Application\UseCase\TipusCentre\UpdateTipusCentreUseCase;
use UicBundle\Application\UseCase\TipusCentre\DeleteTipusCentreUseCase;
use UicBundle\Domain\Entity\TipusCentre\TipusCentre;
use UicBundle\Infrastructure\Form\TipusCentre\TipusCentreType;

/**
 * TipusCentre\TipusCentre controller.
 *
 */
class TipusCentreController extends Controller
{
    /**
     * Lists all TipusCentre\TipusCentre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipusCentres = $em->getRepository('UicBundle:TipusCentre\TipusCentre')->findAll();

        return $this->render('tipuscentre/index.html.twig', array(
            'tipusCentres' => $tipusCentres,
        ));
    }

    /**
     * Creates a new TipusCentre\TipusCentre entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $newForm = $this->createForm('UicBundle\Infrastructure\Form\TipusCentre\TipusCentreType');

        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $tipusCentreObjectDataTransformer = new TipusCentreObjectDataTransformer();
            $createTipusCentreUseCase = new CreateTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'), $tipusCentreObjectDataTransformer);

            $paramsEntity = $request->request->get($newForm->getName());

            $createTipusCentreRequest = new CreateTipusCentreRequest();
            $createTipusCentreRequest->setDescriCat($paramsEntity['descriCat']);
            $createTipusCentreRequest->setDescriEng($paramsEntity['descriEng']);
            $createTipusCentreRequest->setDescriEsp($paramsEntity['descriEsp']);

            $tipusCentre = $createTipusCentreUseCase->run($createTipusCentreRequest);

            return $this->redirectToRoute('tipuscentre_index');
        }

        return $this->render('tipuscentre/new.html.twig', array(
            'form' => $newForm->createView(),
        ));
    }

    /**
     * Finds and displays a TipusCentre\TipusCentre entity.
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipusCentreRespository = $em->getRepository('UicBundle:TipusCentre\TipusCentre');
        $tipusCentre = $tipusCentreRespository->find($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $deleteForm = $this->createDeleteForm($tipusCentre->getId());

        return $this->render('tipuscentre/show.html.twig', array(
            'tipusCentre' => $tipusCentre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipusCentre\TipusCentre entity.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipusCentreRespository = $em->getRepository('UicBundle:TipusCentre\TipusCentre');
        $tipusCentre = $tipusCentreRespository->find($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $values = [ 'descriCat' => $tipusCentre->getDescriCat(),
                    'descriEsp' => $tipusCentre->getDescriEsp(),
                    'descriEng' => $tipusCentre->getDescriEng(),
                    ];

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm('UicBundle\Infrastructure\Form\TipusCentre\TipusCentreType', $values);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // si tot és vàlid, es fa el COMMIT de la transacció

            $tipusCentreObjectDataTransformer = new TipusCentreObjectDataTransformer();
            $tipusCentreUpdateUseCase = new UpdateTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'), $tipusCentreObjectDataTransformer);

            $paramsEntity = $request->request->get($editForm->getName());

            $updateTipusCentreRequest = new UpdateTipusCentreRequest();
            $updateTipusCentreRequest->setId($id);
            $updateTipusCentreRequest->setDescriCat($paramsEntity['descriCat']);
            $updateTipusCentreRequest->setDescriEsp($paramsEntity['descriEsp']);
            $updateTipusCentreRequest->setDescriEng($paramsEntity['descriEng']);

            $tipusCentre = $tipusCentreUpdateUseCase->run($updateTipusCentreRequest);

            return $this->redirectToRoute('tipuscentre_index');
        }

        return $this->render('tipuscentre/edit.html.twig', array(
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipusCentre\TipusCentre entity.
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

            $tipusCentreDeleteUseCase = new DeleteTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'));
            $tipusCentreDeleteRequest = new DeleteTipusCentreRequest();
            $tipusCentreDeleteRequest->setId($id);
            $tipusCentreDeleteUseCase->run($tipusCentreDeleteRequest);

        }

        return $this->redirectToRoute('tipuscentre_index');
    }

    /**
     * Creates a form to delete a TipusCentre\TipusCentre entity.
     *
     * @param $id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipuscentre_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
