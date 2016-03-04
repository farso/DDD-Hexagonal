<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Centre;
use AppBundle\Factory\CentreFactory;
use AppBundle\Form\CentreType;

use Uic\Application\UseCase\Centre\FindAllCentreUseCase;
use Uic\Application\UseCase\Centre\FindCentreUseCase;
use Uic\Application\UseCase\Centre\UpdateCentreUseCase;
use Uic\Application\UseCase\Centre\CreateCentreUseCase;
use Uic\Application\UseCase\Centre\DeleteCentreUseCase;


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

        $centreFindAllUseCase = new FindAllCentreUseCase($em->getRepository('AppBundle:Centre'));
        $centresDomini = $centreFindAllUseCase->run();

        $centresInf = CentreFactory::transform($centresDomini);

        return $this->render('centre/index.html.twig', array(
            'centres' => $centresInf,
        ));

    }

    /**
     * Creates a new Centre entity.
     *
     */
    public function newAction(Request $request)
    {
        $centre = new Centre();
        $form = $this->createForm('AppBundle\Form\CentreType', $centre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($centre);
            $em->flush();

            return $this->redirectToRoute('centre_show', array('id' => $centre->getId()));
        }

        return $this->render('centre/new.html.twig', array(
            'centre' => $centre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Centre entity.
     *
     */
    public function showAction(Centre $centre)
    {
        $deleteForm = $this->createDeleteForm($centre);

        return $this->render('centre/show.html.twig', array(
            'centre' => $centre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Centre entity.
     *
     */
    public function editAction(Request $request, Centre $centre)
    {
        $deleteForm = $this->createDeleteForm($centre);
        $editForm = $this->createForm('AppBundle\Form\CentreType', $centre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($centre);
            $em->flush();

            return $this->redirectToRoute('centre_edit', array('id' => $centre->getId()));
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
    public function deleteAction(Request $request, Centre $centre)
    {
        $form = $this->createDeleteForm($centre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($centre);
            $em->flush();
        }

        return $this->redirectToRoute('centre_index');
    }

    /**
     * Creates a form to delete a Centre entity.
     *
     * @param Centre $centre The Centre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Centre $centre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('centre_delete', array('id' => $centre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
