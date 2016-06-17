<?php

namespace UicBundle\Controller\TipusCentre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UicBundle\Application\UseCase\TipusCentre\CreateTipusCentreUseCase;
use UicBundle\Application\UseCase\TipusCentre\FindTipusCentreUseCase;
use UicBundle\Application\UseCase\TipusCentre\UpdateTipusCentreUseCase;
use UicBundle\Application\UseCase\TipusCentre\DeleteTipusCentreUseCase;
use UicBundle\Domain\Entity\TipusCentre\TipusCentre;
use UicBundle\Infrastructure\Form\TipusCentre\TipusCentreTypePro;

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
     *
     */
    public function newAction(Request $request)
    {

        $newForm = TipusCentreTypePro::newForm($this->get('form.factory'));

        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $createTipusCentreUseCase = new CreateTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'));

            $paramsEntity = $request->request->get(TipusCentreTypePro::NOM_FORM);

            $tipusCentre = $createTipusCentreUseCase->run($paramsEntity);

            
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

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'));
        $tipusCentre = $tipusCentreFindUseCase->run($id);

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
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'));
        $tipusCentre = $tipusCentreFindUseCase->run($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $values = [ 'descriCat' => $tipusCentre->getDescriCat(),
                    'descriEsp' => $tipusCentre->getDescriEsp(),
                    'descriEng' => $tipusCentre->getDescriEng(),
                    ];

        $deleteForm = $this->createDeleteForm($tipusCentre->getId());
        $editForm = TipusCentreTypePro::newForm($this->get('form.factory'), $values);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // si tot és vàlid, es fa el COMMIT de la transacció
       
            $tipusCentreUpdateUseCase = new UpdateTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'));

            $paramsEntity = $request->request->get(TipusCentreTypePro::NOM_FORM);
            $paramsEntity['id'] = $id;

            $tipusCentre = $tipusCentreUpdateUseCase->run($paramsEntity);

            return $this->redirectToRoute('tipuscentre_index');
        }

        return $this->render('tipuscentre/edit.html.twig', array(
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

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'));
        $tipusCentre = $tipusCentreFindUseCase->run($id);

        if (!$tipusCentre) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $deleteForm = $this->createDeleteForm($tipusCentre->getId());
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {

            $tipusCentreDeleteUseCase = new DeleteTipusCentreUseCase($em->getRepository('UicBundle:TipusCentre\TipusCentre'));
            $tipusCentreDeleteUseCase->run($id);

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
        $tipusCentreDeleteFormBuilder = TipusCentreTypePro::deleteFormBuilder($this->get('form.factory'));

        $tipusCentreDeleteFormBuilder
            ->setAction($this->generateUrl('tipuscentre_delete', array('id' => $id)))
            ->setMethod('DELETE');

        return $tipusCentreDeleteFormBuilder->getForm();
    }
}
