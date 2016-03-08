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

            $centreCreateUseCase = new CreateCentreUseCase($em->getRepository('AppBundle:Centre'));

            $paramsEntity = $request->request->get('centre');

            $centreDomini = $centreCreateUseCase->run(
                    $paramsEntity['nombre'],
                    $paramsEntity['codi']
                );


            $centre = CentreFactory::create($centreDomini->getId(), $centreDomini->getNombre(), $centreDomini->getCodi());

            return $this->redirectToRoute('centre_index');
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
    public function showAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $centreFindUseCase = new FindCentreUseCase($em->getRepository('AppBundle:Centre'));
        $centreDomini = $centreFindUseCase->run($id);

        if (!$centreDomini) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $centre = CentreFactory::create($centreDomini->getId(), $centreDomini->getNombre(), $centreDomini->getCodi());

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
    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $centreFindUseCase = new FindCentreUseCase($em->getRepository('AppBundle:Centre'));
        $centreDomini = $centreFindUseCase->run($id);

        if (!$centreDomini) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $centre = CentreFactory::create($centreDomini->getId(), $centreDomini->getNombre(), $centreDomini->getCodi());

        $deleteForm = $this->createDeleteForm($centre);
        $editForm = $this->createForm('AppBundle\Form\CentreType', $centre);
        $editForm->handleRequest($request);
        //handleRequest: s'encarrega de fer les modificacions a l'objecte de INF

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // si tot és vàlid, es fa el COMMIT de la transacció
       
            $centreUpdateUseCase = new UpdateCentreUseCase($em->getRepository('AppBundle:Centre'));

            $paramsEntity = $request->request->get('centre');

            $centreDomini = $centreUpdateUseCase->run(
                $id, 
                $paramsEntity['nombre'],
                $paramsEntity['codi']
            ); 

            $centre = CentreFactory::create($centreDomini->getId(), $centreDomini->getNombre(), $centreDomini->getCodi());

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

        $centreFindUseCase = new FindCentreUseCase($em->getRepository('AppBundle:Centre'));
        $centreDomini = $centreFindUseCase->run($id);

        if (!$centreDomini) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $centre = CentreFactory::create($centreDomini->getId(), $centreDomini->getNombre(), $centreDomini->getCodi());

        $form = $this->createDeleteForm($centre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $centreDeleteUseCase = new DeleteCentreUseCase($em->getRepository('AppBundle:Centre'));
            $centreDeleteUseCase->run($id); 

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
