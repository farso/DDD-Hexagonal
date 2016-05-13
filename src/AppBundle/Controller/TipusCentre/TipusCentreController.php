<?php

namespace AppBundle\Controller\TipusCentre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\TipusCentre\TipusCentre;
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
            $em->persist($tipusCentre);
            $em->flush();

            return $this->redirectToRoute('tipuscentre_show', array('id' => $tipusCentre->getId()));
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
    public function showAction(TipusCentre $tipusCentre)
    {
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
    public function editAction(Request $request, TipusCentre $tipusCentre)
    {
        $deleteForm = $this->createDeleteForm($tipusCentre);
        $editForm = $this->createForm('AppBundle\Form\TipusCentre\TipusCentreType', $tipusCentre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipusCentre);
            $em->flush();

            return $this->redirectToRoute('tipuscentre_edit', array('id' => $tipusCentre->getId()));
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
    public function deleteAction(Request $request, TipusCentre $tipusCentre)
    {
        $form = $this->createDeleteForm($tipusCentre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipusCentre);
            $em->flush();
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
