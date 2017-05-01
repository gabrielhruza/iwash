<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TipoLavado;
use AppBundle\Form\TipoLavadoType;

/**
 * TipoLavado controller.
 *
 * @Route("/tipolavado")
 */
class TipoLavadoController extends Controller
{
    /**
     * Lists all TipoLavado entities.
     *
     * @Route("/", name="admin_tipolavado_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoLavados = $em->getRepository('AppBundle:TipoLavado')->findAll();

        return $this->render('tipolavado/index.html.twig', array(
            'tipoLavados' => $tipoLavados,
        ));
    }

    /**
     * Creates a new TipoLavado entity.
     *
     * @Route("/new", name="admin_tipolavado_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoLavado = new TipoLavado();
        $form = $this->createForm('AppBundle\Form\TipoLavadoType', $tipoLavado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoLavado);
            $em->flush();

            return $this->redirectToRoute('admin_tipolavado_show', array('id' => $tipoLavado->getId()));
        }

        return $this->render('tipolavado/new.html.twig', array(
            'tipoLavado' => $tipoLavado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoLavado entity.
     *
     * @Route("/{id}", name="admin_tipolavado_show")
     * @Method("GET")
     */
    public function showAction(TipoLavado $tipoLavado)
    {
        $deleteForm = $this->createDeleteForm($tipoLavado);

        return $this->render('tipolavado/show.html.twig', array(
            'tipoLavado' => $tipoLavado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoLavado entity.
     *
     * @Route("/{id}/edit", name="admin_tipolavado_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoLavado $tipoLavado)
    {
        $deleteForm = $this->createDeleteForm($tipoLavado);
        $editForm = $this->createForm('AppBundle\Form\TipoLavadoType', $tipoLavado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoLavado);
            $em->flush();

            return $this->redirectToRoute('admin_tipolavado_edit', array('id' => $tipoLavado->getId()));
        }

        return $this->render('tipolavado/edit.html.twig', array(
            'tipoLavado' => $tipoLavado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoLavado entity.
     *
     * @Route("/{id}", name="admin_tipolavado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoLavado $tipoLavado)
    {
        $form = $this->createDeleteForm($tipoLavado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoLavado);
            $em->flush();
        }

        return $this->redirectToRoute('admin_tipolavado_index');
    }

    /**
     * Creates a form to delete a TipoLavado entity.
     *
     * @param TipoLavado $tipoLavado The TipoLavado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoLavado $tipoLavado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tipolavado_delete', array('id' => $tipoLavado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
