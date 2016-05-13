<?php

namespace AppBundle\Controller\Departaments;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Departaments\Departaments;
use AppBundle\Form\Departaments\DepartamentsType;

/**
 * Departaments\Departaments controller.
 *
 */
class DepartamentsController extends Controller
{
    /**
     * Lists all Departaments\Departaments entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departaments\Departaments = $em->getRepository('AppBundle:Departaments\Departaments')->findAll();

        return $this->render('departaments/departaments/index.html.twig', array(
            'departaments\Departaments' => $departaments\Departaments,
        ));
    }

    /**
     * Creates a new Departaments\Departaments entity.
     *
     */
    public function newAction(Request $request)
    {
        $departaments\Departament = new Departaments();
        $form = $this->createForm('AppBundle\Form\DepartamentsType', $departaments\Departament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departaments\Departament);
            $em->flush();

            return $this->redirectToRoute('departaments_show', array('id' => $departaments\Departament->getId()));
        }

        return $this->render('departaments/departaments/new.html.twig', array(
            'departaments\Departament' => $departaments\Departament,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Departaments\Departaments entity.
     *
     */
    public function showAction(Departaments $departaments\Departament)
    {
        $deleteForm = $this->createDeleteForm($departaments\Departament);

        return $this->render('departaments/departaments/show.html.twig', array(
            'departaments\Departament' => $departaments\Departament,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Departaments\Departaments entity.
     *
     */
    public function editAction(Request $request, Departaments $departaments\Departament)
    {
        $deleteForm = $this->createDeleteForm($departaments\Departament);
        $editForm = $this->createForm('AppBundle\Form\DepartamentsType', $departaments\Departament);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departaments\Departament);
            $em->flush();

            return $this->redirectToRoute('departaments_edit', array('id' => $departaments\Departament->getId()));
        }

        return $this->render('departaments/departaments/edit.html.twig', array(
            'departaments\Departament' => $departaments\Departament,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Departaments\Departaments entity.
     *
     */
    public function deleteAction(Request $request, Departaments $departaments\Departament)
    {
        $form = $this->createDeleteForm($departaments\Departament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departaments\Departament);
            $em->flush();
        }

        return $this->redirectToRoute('departaments_index');
    }

    /**
     * Creates a form to delete a Departaments\Departaments entity.
     *
     * @param Departaments $departaments\Departament The Departaments\Departaments entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departaments $departaments\Departament)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('departaments_delete', array('id' => $departaments\Departament->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
