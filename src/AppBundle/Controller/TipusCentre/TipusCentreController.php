<?php

namespace AppBundle\Controller\TipusCentre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\TipusCentre\TipusCentreTypePro;
use ApplicationBundle\UseCase\TipusCentre\CreateTipusCentreUseCase;
use ApplicationBundle\UseCase\TipusCentre\FindTipusCentreUseCase;
use ApplicationBundle\UseCase\TipusCentre\UpdateTipusCentreUseCase;
use ApplicationBundle\UseCase\TipusCentre\DeleteTipusCentreUseCase;
use DomainBundle\Entity\TipusCentre\TipusCentre;

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

        $tipusCentreRepository = $em->getRepository('DomainBundle:TipusCentre\TipusCentre');
        $tipusCentres = $tipusCentreRepository->findAll();

        return $this->render('tipuscentre/index.html.twig', array(
            'tipusCentres' => $tipusCentres,
        ));
    }

    /**
     * Creates a new TipusCentre\TipusCentre entity.
     *
     */
    public function newAction(Request $request)
    {
        $newFormBuilder = TipusCentreTypePro::newForm($this->get('form.factory'));
        $newForm = $newFormBuilder->getForm();
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $tipusCentreRepository = $em->getRepository('DomainBundle:TipusCentre\TipusCentre');
            $paramsEntity = $request->request->get(tipusCentreTypePro::NAMEFORM);
            $createTipusCentreUseCase = new CreateTipusCentreUseCase($tipusCentreRepository);
            $TipusCentre = $createTipusCentreUseCase->run($paramsEntity);

            return $this->redirectToRoute('tipuscentre_index');
        }
        return $this->render('tipuscentre/new.html.twig', array(
            'form' => $newForm->createView(),
        ));
    }

    /**
     * Finds and displays a TipusCentre\TipusCentre entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tipusCentreRepository = $em->getRepository('DomainBundle:TipusCentre\TipusCentre');
        $tipusCentre = $tipusCentreRepository->find($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $deleteFormBuilder = $this->createDeleteForm($id);
        $deleteForm = $deleteFormBuilder->getForm();
        return $this->render('tipuscentre/show.html.twig', array(
            'tipusCentre' => $tipusCentre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipusCentre\TipusCentre entity.
     *
     */
    public function editAction(Request $request, $id)
    {


        $em = $this->getDoctrine()->getManager();
        $tipusCentreRepository = $em->getRepository('DomainBundle:TipusCentre\TipusCentre');
        $tipusCentre = $tipusCentreRepository->find($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $deleteFormBuilder = $this->createDeleteForm($id);
        $deleteForm = $deleteFormBuilder->getForm();
        $values = [ 'descriCat' => $tipusCentre->getDescriCat(),
                    'descriEsp' => $tipusCentre->getDescriEsp(),
                    'descriEng' => $tipusCentre->getDescriEng()
                    ];
        $editFormBuilder = TipusCentreTypePro::newForm($this->get('form.factory'), $values);
        $editForm = $editFormBuilder->getForm();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // si tot és vàlid, es fa el COMMIT de la transacció
       
            $tipusCentreUpdateUseCase = new UpdateTipusCentreUseCase($em->getRepository('DomainBundle:TipusCentre\TipusCentre'));
            $paramsEntity = $request->request->get(tipusCentreTypePro::NAMEFORM);
            $paramsEntity['id'] = $id;

            $tipusCentre = $tipusCentreUpdateUseCase->run($paramsEntity);

            return $this->redirectToRoute('tipuscentre_index');
        }

        return $this->render('tipuscentre/edit.html.twig', array(
            'tipusCentre' => $tipusCentre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipusCentre\TipusCentre entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $tipusCentreRepository = $em->getRepository('DomainBundle:TipusCentre\TipusCentre');
        $tipusCentre = $tipusCentreRepository->find($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $deleteFormBuilder = $this->createDeleteForm($id);
        $deleteForm = $deleteFormBuilder->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {

            $tipusCentreDeleteUseCase = new DeleteTipusCentreUseCase($em->getRepository('DomainBundle:TipusCentre\TipusCentre'));
            $tipusCentreDeleteUseCase->run($tipusCentre);

        }

        return $this->redirectToRoute('tipuscentre_index');
    }

    /**
     * Creates a form to delete a TipusCentre\TipusCentre entity.
     *
     * @param TipusCentre $tipusCentre The TipusCentre\TipusCentre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {

        $tipusCentreDeleteForm = TipusCentreTypePro::deleteForm($this->get('form.factory'));
        $tipusCentreDeleteForm->setAction($this->generateUrl('tipuscentre_delete', array('id' => $id)))
            ->setMethod('DELETE');
        return $tipusCentreDeleteForm;
        ;
    }
}
