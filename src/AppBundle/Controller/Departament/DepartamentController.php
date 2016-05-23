<?php

namespace AppBundle\Controller\Departament;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Departament\Departament;
use AppBundle\Form\Departament\DepartamentType;
use AppBundle\Factory\DepartamentFactoryInf;
use Uic\Application\UseCase\Departament\FindAllDepartamentUseCase;
use Uic\Application\UseCase\Departament\CreateDepartamentUseCase;
use Uic\Application\UseCase\Departament\FindDepartamentUseCase;
use Uic\Application\UseCase\Departament\UpdateDepartamentUseCase;

/**
 * Departaments\Departaments controller.
 *
 */
class DepartamentController extends Controller
{
    /**
     * Lists all Departaments\Departaments entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $departamentFindAllUseCase = new FindAllDepartamentUseCase($em->getRepository('AppBundle:Departament\Departament'));
        $departamentsDomini = $departamentFindAllUseCase->run();

        $departamentsInf = DepartamentFactoryInf::transform($departamentsDomini);

        return $this->render('departament/index.html.twig', array(
            'departaments' => $departamentsInf,
        ));
    }

    /**
     * Creates a new Departaments\Departaments entity.
     *
     */
    public function newAction(Request $request)
    {
        $departament = DepartamentFactoryInf::emptyEntity();
        $form = $this->createForm('AppBundle\Form\Departament\DepartamentType', $departament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $departamentCreateUseCase = new CreateDepartamentUseCase($em->getRepository('AppBundle:Departament\Departament'));

            $paramsEntity = $request->request->get('departament');
            $departamentDom = $departamentCreateUseCase->run($paramsEntity);


            $departament = DepartamentFactoryInf::create($departamentDom->toArray());

            return $this->redirectToRoute('departament_index');
        }

        return $this->render('departament/new.html.twig', array(
            'departament' => $departament,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Departaments\Departaments entity.
     *
     */
    public function showAction($id)
    {
       $em = $this->getDoctrine()->getManager();

       $departamentFindUseCase = new FindDepartamentUseCase($em->getRepository('AppBundle:Departament\Departament'));
       $departamentDom = $departamentFindUseCase->run($id);

       if (!$departamentDom) {
        throw $this->createNotFoundException('Unable to find Departament entity.');
        }

        $departament = DepartamentFactoryInf::create($departamentDom->toArray());

        $deleteForm = $this->createDeleteForm($departament);

        return $this->render('departament/show.html.twig', array(
            'departament' => $departament,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Departaments\Departaments entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $departamentFindUseCase = new FindDepartamentUseCase($em->getRepository('AppBundle:Departament\Departament'));
        $departamentDom = $departamentFindUseCase->run($id);

        if (!$departamentDom) {
            throw $this->createNotFoundException('Unable to find Departament entity.');
        }

        $departament = DepartamentFactoryInf::create($departamentDom->toArray());

        $deleteForm = $this->createDeleteForm($departament);
        $editForm = $this->createForm('AppBundle\Form\Departament\DepartamentType', $departament);
        $editForm->handleRequest($request);
        //handleRequest: s'encarrega de fer les modificacions a l'objecte de INF

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // si tot és vàlid, es fa el COMMIT de la transacció
       
            $departamentUpdateUseCase = new UpdateDepartamentUseCase($em->getRepository('AppBundle:Departament\Departament'));

            $paramsEntity = $request->request->get('departament');
            $paramsEntity['id'] = $id;

            $departamentDom = $departamentUpdateUseCase->run($paramsEntity); 

            $departament = DepartamentFactoryInf::create($departamentDom->toArray());

            return $this->redirectToRoute('departament_index');
        }

        return $this->render('departament/edit.html.twig', array(
            'departament' => $departament,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Departaments\Departaments entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $departamentFindUseCase = new FindDepartamentUseCase($em->getRepository('AppBundle:Departament\Departament'));
        $departamentDom = $departamentFindUseCase->run($id);

        if (!$departamentDom) {
            throw $this->createNotFoundException('Unable to find Departament entity.');
        }

        $departament = DepartamentFactoryInf::create($departamentDom->toArray());

        $form = $this->createDeleteForm($departament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $departamentDeleteUseCase = new DeleteDepartamentUseCase($em->getRepository('AppBundle:Departament\Departament'));
            $departamentDeleteUseCase->run($id); 

        }

        return $this->redirectToRoute('departament_index');
    }

    /**
     * Creates a form to delete a Departaments\Departaments entity.
     *
     * @param Departaments $departaments\Departament The Departaments\Departaments entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departament $departament)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('departament_delete', array('id' => $departament->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
