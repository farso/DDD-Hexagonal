<?php

namespace AppBundle\Controller\TipusCentre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApplicationBundle\UseCase\TipusCentre\CreateTipusCentreUseCase;
use ApplicationBundle\UseCase\TipusCentre\FindTipusCentreUseCase;
use ApplicationBundle\UseCase\TipusCentre\UpdateTipusCentreUseCase;
use ApplicationBundle\UseCase\TipusCentre\DeleteTipusCentreUseCase;
use AppBundle\Entity\TipusCentre\TipusCentre;
use AppBundle\Factory\TipusCentreFactoryInf;
use AppBundle\Form\TipusCentre\TipusCentreType;

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

        $tipusCentres = $em->getRepository('AppBundle:TipusCentre\TipusCentre')->findAll();

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
        $tipusCentre = new TipusCentre();
        $form = $this->createForm('AppBundle\Form\TipusCentre\TipusCentreType', $tipusCentre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $createTipusCentreUseCase = new CreateTipusCentreUseCase($em->getRepository('AppBundle:TipusCentre\TipusCentre'));

            $paramsEntity = $request->request->get('tipus_centre');

            $tipusCentreDom = $createTipusCentreUseCase->run($paramsEntity);

            $tipusCentre = TipusCentreFactoryInf::create($tipusCentreDom->toArray());
            
            return $this->redirectToRoute('tipuscentre_index');

        }

        return $this->render('tipuscentre/new.html.twig', array(
            'tipusCentre' => $tipusCentre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipusCentre\TipusCentre entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($em->getRepository('AppBundle:TipusCentre\TipusCentre'));
        $tipusCentreDom = $tipusCentreFindUseCase->run($id);

        if (!$tipusCentreDom) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $tipusCentre = TipusCentreFactoryInf::create($tipusCentreDom->toArray());


        $deleteForm = $this->createDeleteForm($tipusCentre);

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

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($em->getRepository('AppBundle:TipusCentre\TipusCentre'));
        $tipusCentreDom = $tipusCentreFindUseCase->run($id);

        if (!$tipusCentreDom) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $tipusCentre = TipusCentreFactoryInf::create($tipusCentreDom->toArray());

        $deleteForm = $this->createDeleteForm($tipusCentre);
        $editForm = $this->createForm('AppBundle\Form\TipusCentre\TipusCentreType', $tipusCentre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // si tot és vàlid, es fa el COMMIT de la transacció
       
            $tipusCentreUpdateUseCase = new UpdateTipusCentreUseCase($em->getRepository('AppBundle:TipusCentre\TipusCentre'));

            $paramsEntity = $request->request->get('tipus_centre');
            $paramsEntity['id'] = $id;

            $tipusCentreDom = $tipusCentreUpdateUseCase->run($paramsEntity); 

            $tipusCentre = TipusCentreFactoryInf::create($tipusCentreDom->toArray());

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

        $tipusCentreFindUseCase = new FindTipusCentreUseCase($em->getRepository('AppBundle:TipusCentre\TipusCentre'));
        $tipusCentreDom = $tipusCentreFindUseCase->run($id);

        if (!$tipusCentreDom) {
            throw $this->createNotFoundException('Unable to find TipusCentre entity.');
        }

        $tipusCentre = TipusCentreFactoryInf::create($tipusCentreDom->toArray());

        $form = $this->createDeleteForm($tipusCentre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tipusCentreDeleteUseCase = new DeleteTipusCentreUseCase($em->getRepository('AppBundle:TipusCentre\TipusCentre'));
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
    private function createDeleteForm(TipusCentre $tipusCentre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipuscentre_delete', array('id' => $tipusCentre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
