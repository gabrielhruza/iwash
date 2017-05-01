<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CentroIntegral;
use AppBundle\Form\CentroIntegralType;

/**
 * CentroIntegral controller.
 *
 * @Route("/admin/centrointegral")
 */
class CentroIntegralController extends Controller
{
    /**
     * Lists all CentroIntegral entities.
     *
     * @Route("/", name="admin_centrointegral_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $centroIntegrals = $em->getRepository('AppBundle:CentroIntegral')->findAll();

        return $this->render('centrointegral/index.html.twig', array(
            'centroIntegrals' => $centroIntegrals,
        ));
    }

    /**
     * Creates a new CentroIntegral entity.
     *
     * @Route("/new", name="admin_centrointegral_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $centroIntegral = new CentroIntegral();
        $form = $this->createForm('AppBundle\Form\CentroIntegralType', $centroIntegral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($centroIntegral);
            $em->flush();

            return $this->redirectToRoute('admin_centrointegral_show', array('id' => $centroIntegral->getId()));
        }

        return $this->render('centrointegral/new.html.twig', array(
            'centroIntegral' => $centroIntegral,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CentroIntegral entity.
     *
     * @Route("/{id}", name="admin_centrointegral_show")
     * @Method("GET")
     */
    public function showAction(CentroIntegral $centroIntegral)
    {
        $deleteForm = $this->createDeleteForm($centroIntegral);

        return $this->render('centrointegral/show.html.twig', array(
            'centroIntegral' => $centroIntegral,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CentroIntegral entity.
     *
     * @Route("/{id}/edit", name="admin_centrointegral_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CentroIntegral $centroIntegral)
    {
        $deleteForm = $this->createDeleteForm($centroIntegral);
        $editForm = $this->createForm('AppBundle\Form\CentroIntegralType', $centroIntegral);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($centroIntegral);
            $em->flush();

            return $this->redirectToRoute('admin_centrointegral_edit', array('id' => $centroIntegral->getId()));
        }

        return $this->render('centrointegral/edit.html.twig', array(
            'centroIntegral' => $centroIntegral,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CentroIntegral entity.
     *
     * @Route("/{id}", name="admin_centrointegral_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CentroIntegral $centroIntegral)
    {
        $form = $this->createDeleteForm($centroIntegral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($centroIntegral);
            $em->flush();
        }

        return $this->redirectToRoute('admin_centrointegral_index');
    }

    /**
     * Creates a form to delete a CentroIntegral entity.
     *
     * @param CentroIntegral $centroIntegral The CentroIntegral entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CentroIntegral $centroIntegral)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_centrointegral_delete', array('id' => $centroIntegral->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
