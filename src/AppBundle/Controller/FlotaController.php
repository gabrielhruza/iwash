<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Flota;
use AppBundle\Form\FlotaType;

/**
 * Flota controller.
 *
 * @Route("/corporativo/flota")
 */
class FlotaController extends Controller
{
    /**
     * Lists all Flota entities.
     *
     * @Route("/", name="corporativo_flota_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $flotas = $em->getRepository('AppBundle:Flota')->findAll();

        return $this->render('flota/index.html.twig', array(
            'flotas' => $flotas,
        ));
    }

    /**
     * Creates a new Flota entity.
     *
     * @Route("/new", name="corporativo_flota_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {   
        $flotum = new Flota();
        $form = $this->createForm('AppBundle\Form\FlotaType', $flotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($flotum);
            $em->flush();

            return $this->redirectToRoute('corporativo_flota_show', array('id' => $flotum->getId()));
        }

        return $this->render('flota/new.html.twig', array(
            'flotum' => $flotum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Flota entity.
     *
     * @Route("/{id}", name="corporativo_flota_show")
     * @Method("GET")
     */
    public function showAction(Flota $flotum)
    {
        $deleteForm = $this->createDeleteForm($flotum);

        return $this->render('flota/show.html.twig', array(
            'flotum' => $flotum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Flota entity.
     *
     * @Route("/{id}/edit", name="corporativo_flota_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Flota $flotum)
    {
        $deleteForm = $this->createDeleteForm($flotum);
        $editForm = $this->createForm('AppBundle\Form\FlotaType', $flotum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($flotum);
            $em->flush();

            return $this->redirectToRoute('corporativo_flota_edit', array('id' => $flotum->getId()));
        }

        return $this->render('flota/edit.html.twig', array(
            'flotum' => $flotum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Flota entity.
     *
     * @Route("/{id}", name="corporativo_flota_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Flota $flotum)
    {
        $form = $this->createDeleteForm($flotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($flotum);
            $em->flush();
        }

        return $this->redirectToRoute('corporativo_flota_index');
    }

    /**
     * Creates a form to delete a Flota entity.
     *
     * @param Flota $flotum The Flota entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Flota $flotum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('corporativo_flota_delete', array('id' => $flotum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
