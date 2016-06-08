<?php

namespace AppBundle\Controller\Centre;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Centre\CentreTypePro;
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

        $centreRepository = $em->getRepository('UicDomainBundle:Centre\Centre');
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
        
        $centreFormBuilder = CentreTypePro::newForm($this->get('form.factory'));
        $form = $centreFormBuilder->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $centreRepository = $em->getRepository('UicDomainBundle:Centre\Centre');
            
            $centreCreateUseCase = new CreateCentreUseCase($centreRepository);

            $paramsEntity = $request->request->get('form');
            $centre = $centreCreateUseCase->run($paramsEntity);

            return $this->redirectToRoute('centre_index');
        }

        return $this->render('centre/new.html.twig', array(
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

        $centreRepository = $em->getRepository('UicDomainBundle:Centre\Centre');        

        $centre = $centreRepository->find($id);

        if (!$centre) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $centreFormBuilder = CentreTypePro::deleteForm($this->get('form.factory'));

        $centreFormBuilder
            ->setAction($this->generateUrl('centre_delete', array('id' => $centre->getId())))
            ->setMethod('DELETE');

        $form = $centreFormBuilder->getForm();

        return $this->render('centre/show.html.twig', array(
            'centre' => $centre,
            'delete_form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Centre entity.
     *
     */
    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $centreFindUseCase = new FindCentreUseCase($em->getRepository('AppBundle:Centre\Centre'));
        $centreDom = $centreFindUseCase->run($id);

        if (!$centreDom) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $centre = CentreFactoryInf::create($centreDom->toArray());

        $deleteForm = $this->createDeleteForm($centre);
        $editForm = $this->createForm('AppBundle\Form\Centre\CentreType', $centre);
        $editForm->handleRequest($request);
        //handleRequest: s'encarrega de fer les modificacions a l'objecte de INF

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // si tot és vàlid, es fa el COMMIT de la transacció
       
            $centreUpdateUseCase = new UpdateCentreUseCase($em->getRepository('AppBundle:Centre\Centre'));

            $paramsEntity = $request->request->get('centre');
            $paramsEntity['id'] = $id;

            $centreDom = $centreUpdateUseCase->run($paramsEntity); 

            $centre = CentreFactoryInf::create($centreDom->toArray());

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

        $centreFindUseCase = new FindCentreUseCase($em->getRepository('AppBundle:Centre\Centre'));
        $centreDom = $centreFindUseCase->run($id);

        if (!$centreDom) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $centre = CentreFactoryInf::create($centreDom->toArray());

        $form = $this->createDeleteForm($centre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $centreDeleteUseCase = new DeleteCentreUseCase($em->getRepository('AppBundle:Centre\Centre'));
            $centreDeleteUseCase->run($id); 

        }

        return $this->redirectToRoute('centre_index');
    }

}
