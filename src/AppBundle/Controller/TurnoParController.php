<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TurnoPar;
use AppBundle\Form\TurnoParType;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


/**
 * TurnoPar controller
 *
 * @Route("/reserva/turnopar")
 */
class TurnoParController extends Controller
{
    /**
     * Lists all TurnoPar entities.
     *
     * @Route("/listar/", name="reserva_turnopar_index")
     * @Method("GET")
     */
    public function listarAction()
    {
        //listado de todos los turnos reservados del usuario con diferencia de mas de 3 horas
        $turnos = $this->getUser()->getTurnos();
        $turnoPars = new ArrayCollection();

        foreach ($turnos as $turnopar) {
            if($turnopar->getEstado() != 'cancelado'){
                $fecha = $turnopar->getFecha();
                $dia  = $fecha->format('Y-m-d');
                $hora = $turnopar->getHora()->format('H:i:s');
                $fecha = $dia . ' ' . $hora ;

                $diaActual = date('Y-m-d');
                $horaActual = date('H:i:s');

                //controlar si diaActual es mayor o igual a dia del turno reservado,
                //si es igual, la hora de reserva debe ser mayor a 3 horas;
                if( $dia > $diaActual ){
                    $turnoPars[] = $turnopar;
                }else{
                    if( $dia == $diaActual ){
                        if( ($hora - $horaActual) > 3 ){
                            $turnoPars[] = $turnopar;
                        }
                    }
                }
            }
        };

        return $this->render('turnopar/index.html.twig', array(
            'turnoPars' => $turnoPars
        ));
    }

    /**
     * Lists all Turnos entities.
     *
     * @Route("/informe/", name="reserva_turnopar_index_completo")
     * @Route("/informe/{page}")
     * @Method("GET")
     */
    public function indexAction($page = null)
    {
        //$em = $this->getDoctrine()->getManager();
        //$turnoPars = $em->getRepository('AppBundle:TurnoPar')->findAll();
        $turnoPars = $this->getUser()->getTurnos();

        $range = 6;
        $pages = count($turnoPars) / $range;
        //die(var_dump($turnoPars));
        $turnoPars  = $turnoPars->slice($page*$range,$range);
        //$turnoPars  = array_slice($turnoPars,$page*$range,$range);

        return $this->render('turnopar/indexcompleto.html.twig', array(
            'turnoPars' => $turnoPars,
            'range' => $range,
            'pages' => $pages,
            'page'  => $page
        ));
    }

    /**
     * Lists all Turnos entities.
     *
     * @Route("/realizar/", name="reserva_turnopar_realizar")
     */
    public function realizarTurnos(){
        $turnoPars = $this->getUser()->getTurnos();



        foreach ($turnoPars as $turnoPar) {
            $año = $turnoPar->getFecha();
            $año = $año->format('Y');
            if($año == '2015'){
                $turnoPar->realizarTurno();                
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($turnoPar);
        $em->flush();

        return $this->redirectToRoute('reserva_turnopar_index_completo');
    }

    /**
     * Creates a new TurnoPar entity.
     *
     * @Route("/new", name="reserva_turnopar_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $turnoPar = new TurnoPar();
        $form = $this->createForm('AppBundle\Form\TurnoParType', $turnoPar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $turnoPar->setUser($this->getUser());
            
            //logica para saber si hay turno disponible a la fecha, hora y sucursal seleccionada.
            
            $fecha  = $turnoPar->getFecha();
            $hora   = $turnoPar->getHora();
            $ci_seleccionado = $turnoPar->getCentroIntegral()->getId();
            $operarios = $turnoPar->getCentroIntegral()->getOperarios();


            //obtengo los turnos del centro integral, fecha y hora seleccionada
            $turnos = $em->getRepository('AppBundle:CentroIntegral')->findAllTurnos($ci_seleccionado, $fecha, $hora);

            //verifico que la cantidad de turnos para el centro integral seleccionado sea menor a la cantidad de operarios
            if( count($turnos) >= $operarios ){

                //en entra aca si no hay turno disponible para el centro integral, fecha y hora seleccionado,
                // entonces obtengo otras sucursales para esa fecha y hora seleccionada
                $ci_alternativos = new ArrayCollection();

                $cis = $em->getRepository('AppBundle:CentroIntegral')->findAll();

                foreach ($cis as $ci) {       
                    $turnos = $em->getRepository('AppBundle:CentroIntegral')->findAllTurnos($ci->getId(), $fecha, $hora);
                    if(count($turnos) < $ci->getOperarios()){
                        $ci_alternativos[] = $ci;
                    }
                }

                return $this->render('turnopar/new.html.twig', array(
                'turnoPar' => $turnoPar,
                'form' => $form->createView(),
                'error' => 'No hay turnos en la fecha y hora seleccionado.',
                'cis'   => $ci_alternativos,
                ));

            }else{

                //seteo el monto de cada turno
                $preciotv = $turnoPar->getVehiculo()->getPrecio();
                $preciotl = $turnoPar->getTipoLavado()->getPrecio();
                $turnoPar->setMonto($preciotl + $preciotv);


                $turnoPar->getCentroIntegral()->addTurnoPar($turnoPar);
                $em->persist($turnoPar);
                $em->flush();
                return $this->render('turnopar/turnoreservado.html.twig');
            }
            }

        return $this->render('turnopar/new.html.twig', array(
            'turnoPar' => $turnoPar,
            'form' => $form->createView(),
            'error' => null,
        ));
        
    }

    /**
     * Finds and displays a TurnoPar entity.
     *
     * @Route("/{id}", name="reserva_turnopar_show")
     * @Method("GET")
     */
    public function showAction(TurnoPar $turnoPar)
    {
        $deleteForm = $this->createDeleteForm($turnoPar);

        return $this->render('turnopar/show.html.twig', array(
            'turnoPar' => $turnoPar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TurnoPar entity.
     *
     * @Route("/{id}/edit", name="reserva_turnopar_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TurnoPar $turnoPar)
    {
        $deleteForm = $this->createDeleteForm($turnoPar);
        $editForm = $this->createForm('AppBundle\Form\TurnoParType', $turnoPar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($turnoPar);
            $em->flush();

            return $this->redirectToRoute('reserva_turnopar_edit', array('id' => $turnoPar->getId()));
        }

        return $this->render('turnopar/edit.html.twig', array(
            'turnoPar' => $turnoPar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TurnoPar entity.
     *
     * @Route("/{id}", name="reserva_turnopar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TurnoPar $turnoPar)
    {
        $form = $this->createDeleteForm($turnoPar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($turnoPar);
            $em->flush();
        }

        return $this->redirectToRoute('reserva_turnopar_index');
    }

    /**
     * Creates a form to delete a TurnoPar entity.
     *
     * @param TurnoPar $turnoPar The TurnoPar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TurnoPar $turnoPar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reserva_turnopar_delete', array('id' => $turnoPar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/montotv/{id}/ajax/", name="turnopar_ajax_tipovehiculo")
     */
    public function ajaxTVFormAction(Request $request, $id)
    {
        
        //$form = $this->createForm(TurnoParType::class, $turnoPar = new TurnoPar());
        //$form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository('AppBundle:Vehiculo')->find($id);
        $precio = $vehiculo->getPrecio();

        return new JsonResponse(array( 'precio' => $precio));
    }

    /**
     * @Route("/montotl/{id}/ajax/", name="turnopar_ajax_tipolavado")
     */
    public function ajaxTLFormAction(Request $request, $id)
    {
        
        //$form = $this->createForm(TurnoParType::class, $turnoPar = new TurnoPar());
        //$form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository('AppBundle:TipoLavado')->find($id);
        $precio = $vehiculo->getPrecio();
        
        return new JsonResponse(array( 'precio' => $precio));
    }

    //cancelar turno
    /**
     * @Route("/listar/{id}/cancelar", name="turnopar_cancelar")
     */
    public function cancelarTurno($id){

        $turnos = $this->getUser()->getTurnos();
        
        foreach ($turnos as $turno) {
               if($turno->getId() == $id){
                $turno->cancelarTurno();
                $em = $this->getDoctrine()->getManager();
                $em->persist($turno);
                $em->flush();
               }
        }

        return $this->redirectToRoute('reserva_turnopar_index');   
    }

    /**
     * @Route("/movil/", name="reserva_turnopar_movil")
     * )
     */
    public function movilFormAction(Request $request)
    {   

        $turnoPar = new TurnoPar();
        $form = $this->createForm(TurnoParType::class, $turnoPar);
        $form->handleRequest($request);
        
        //die(var_dump($form->createView()));

        return $this->render('turnopar/new.html.twig', array(
            'form' => $form->createView(),
            'error' => null,
         ));
    }
}
