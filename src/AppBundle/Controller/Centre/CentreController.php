<?php

namespace AppBundle\Controller\Centre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Centre\CentreTypePro;
use ApplicationBundle\UseCase\Centre\UpdateCentreUseCase;
use ApplicationBundle\UseCase\Centre\CreateCentreUseCase;
use ApplicationBundle\UseCase\Centre\DeleteCentreUseCase;
use DomainBundle\Entity\Centre\Centre;

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

        $centreRepository = $em->getRepository('DomainBundle:Centre\Centre');
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
        
        $newForm = CentreTypePro::newForm($this->get('form.factory'));
        
        $newForm->handleRequest($request);
        if ($newForm->isSubmitted() && $newForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $centreRepository = $em->getRepository('DomainBundle:Centre\Centre');
            
            $centreCreateUseCase = new CreateCentreUseCase($centreRepository);
            $paramsEntity = $request->request->get('form');

            $centre = $centreCreateUseCase->run($paramsEntity);
            //$centre = new Centre($request);

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

        $centreRepository = $em->getRepository('DomainBundle:Centre\Centre');

        $centre = $centreRepository->find($id);

        if (!$centre) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $deleteFormBuilder = $this->createDeleteForm($centre->getId());

        $deleteForm = $deleteFormBuilder->getForm();

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

        $centreRepository = $em->getRepository('DomainBundle:Centre\Centre');
        $centre = $centreRepository->find($id);

        if (!$centre) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $deleteFormBuilder = $this->createDeleteForm($id);
        $deleteForm = $deleteFormBuilder->getForm();

        //prova @todo TRANSFORMER CAP A ARRAY PER LA VISTA
        $values = [ 'nombre' => $centre->getNombre(),
                    'codi' => $centre->getCodi(),
                    'codiOficial' => $centre->getCodiOficial(),
                    'mailCentre' => $centre->getMailCentre(),
                    'color' => $centre->getColor()
                    ];

        $editForm = CentreTypePro::newForm($this->get('form.factory'), $values);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
       
            $centreUpdateUseCase = new UpdateCentreUseCase($em->getRepository('DomainBundle:Centre\Centre'));

            $paramsEntity = $request->request->get('form');
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

        $centreRepository = $em->getRepository('DomainBundle:Centre\Centre');
        $centre = $centreRepository->find($id);

        if (!$centre) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $deleteFormBuilder = $this->createDeleteForm($id);
        $deleteForm = $deleteFormBuilder->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {

            $centreDeleteUseCase = new DeleteCentreUseCase($em->getRepository('DomainBundle:Centre\Centre'));
            $centreDeleteUseCase->run($id);

        }

        return $this->redirectToRoute('centre_index');
    }


    private function createDeleteForm($id)
    {
        $centreDeleteForm = CentreTypePro::deleteFormBuilder($this->get('form.factory'));

        $centreDeleteForm
            ->setAction($this->generateUrl('centre_delete', array('id' => $id)))
            ->setMethod('DELETE');

        return $centreDeleteForm;
    }
}
