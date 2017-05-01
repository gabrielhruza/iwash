<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\ArrayCollection;

use AppBundle\Entity\Plan;
use AppBundle\Form\PlanType;

/**
 * Plan controller.
 *
 * @Route("/corporativo/plan")
 */
class PlanController extends Controller
{
    /**
     * Lists all Plan entities.
     *
     * @Route("/", name="corporativo_plan_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plans = $em->getRepository('AppBundle:Plan')->findByUser($this->getUser());

        return $this->render('plan/planes.html.twig', array(
            'plans' => $plans,
        ));
    }


    /**
     * Creates a new Plan entity.
     *
     * @Route("/new", name="corporativo_plan_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plan = new Plan();

        // dummy code - this is here just so that the Task has some tags
        // otherwise, this isn't an interesting example
        /*$tag1 = new Tag();
        $tag1->name = 'tag1';
        $task->getTags()->add($tag1);
        $tag2 = new Tag();
        $tag2->name = 'tag2';
        $task->getTags()->add($tag2);*/
        // end dummy code

        $form = $this->createForm(PlanType::class, $plan);

        $form->handleRequest($request);



        if ($form->isSubmitted()) {

            foreach ($plan->getFlotas() as $flota ) {
                $flota->setPlan($plan);
            }

            $plan->setEstado('enviado');
            //$plan->setMonto(200);
            $plan->calcularMonto();
            $plan->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();

            $em->persist($plan);
            $em->flush();

            return $this->redirectToRoute('corporativo_plan_index');
        }

        return $this->render('plan/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Plan entity.
     *
     * @Route("/{id}/ver", name="corporativo_plan_show")
     * @Method("GET")
     */
    public function showAction(Plan $plan)
    {
        $deleteForm = $this->createDeleteForm($plan);

        return $this->render('plan/show.html.twig', array(
            'plan' => $plan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Plan entity.
     *
     * @Route("/{id}/edit", name="corporativo_plan_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, Request $request)
    {
    $em = $this->getDoctrine()->getManager();
    $plan = $em->getRepository('AppBundle:Plan')->find($id);

    if (!$plan) {
        throw $this->createNotFoundException('No Plan found for id '.$id);
    }

    $originalFlotas = new ArrayCollection();

    // Create an ArrayCollection of the current Flota objects in the database
    foreach ($plan->getFlotas() as $flota) {
        $originalFlotas->add($flota);
    }

    $editForm = $this->createForm(PlanType::class, $plan);

    $editForm->handleRequest($request);

    if ($editForm->isSubmitted()) {

        //die(var_dump('aqui estoy'));
        // remove the relationship between the flota and the Plan
        foreach ($originalFlotas as $flota) {
            if (false === $plan->getFlotas()->contains($flota)) {
                // remove the Plan from the Flota
                //$flota->getFlotas()->removeElement($flota);
                //die(var_dump('aqui estoy'));
                // if it was a many-to-one relationship, remove the relationship like this
                //$flota->setPlan(null);

                //$em->persist($flota);

                // if you wanted to delete the Flota entirely, you can also do that
                $em->remove($flota);
            }
        }

        foreach ($plan->getFlotas() as $flota ){
            $flota->setPlan($plan);
        }

        $plan->calcularMonto();
        $em->persist($plan);
        $em->flush();

        // redirect back to some edit page
        return $this->redirectToRoute('corporativo_plan_edit', array('id' => $id));
    }

    return $this->render('plan/new.html.twig', array(
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Plan entity.
     *
     * @Route("/{id}", name="corporativo_plan_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plan $plan)
    {
        $form = $this->createDeleteForm($plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plan);
            $em->flush();
        }

        return $this->redirectToRoute('corporativo_plan_index');
    }

    /**
     * Creates a form to delete a Plan entity.
     *
     * @param Plan $plan The Plan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plan $plan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('corporativo_plan_delete', array('id' => $plan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing Plan entity.
     *
     * @Route("/{id}/planificar", name="corporativo_plan_planificar")
     * @Method({"GET", "POST"})
     */
    public function planificarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $plan   = $em->getRepository('AppBundle:Plan')->find($id);

        //var_dump($plan->getUser());

        if( ( $plan->getUser() == $this->getUser()) && ($plan->getEstado() == 'aprobado') ){

        return $this->render('plan/show.html.twig', array(
            'plan' => $plan,
        ));

        }else{
            return $this->redirectToRoute('corporativo_plan_index');
        }


    }


}
