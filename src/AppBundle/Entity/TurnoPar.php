<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TurnoPar
 *
 * @ORM\Table(name="turno_par")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TurnoParRepository")
 */
class TurnoPar
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Date
     * @Assert\NotBlank(message="Debe ingresar una fecha")
     * @Assert\Date()
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var \Time
     * @Assert\NotBlank(message="Debe ingresar una hora")
     * @Assert\Time()
     * @ORM\Column(name="hora", type="time")
     */
    private $hora;


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Vehiculo", inversedBy="parturnos")
     * @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id", nullable=false)
     */
    private $vehiculo;

    /**
     * @ORM\ManyToOne(targetEntity="TipoLavado", inversedBy="parturnos")
     * @ORM\JoinColumn(name="tipolavado_id", referencedColumnName="id", nullable=false)
     */
    private $tipolavado;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="turnos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    
    /**
     * @ORM\ManyToOne(targetEntity="CentroIntegral", inversedBy="turnopars")
     * @ORM\JoinColumn(name="centrointegral_id", referencedColumnName="id", nullable=false)
     */
    private $centrointegral;

    /**
    * @ORM\Column(name="monto", type="integer")
    */
    private $monto;

    /**
     * @ORM\ManyToOne(targetEntity="Operario", inversedBy="turnopars")
     * @ORM\JoinColumn(name="operario_id", referencedColumnName="id", nullable=true)
     */
    private $operario;

    /**
    * @ORM\Column(name="fechahoracierre", type="datetime", nullable=true)
    */
    private $fechahoracierre;

    /**
    * @ORM\Column(name="estado", type="string")
    */
    private $estado; 

    /**
    * @ORM\Column(name="movil", type="boolean")
    */
    private $movil;

    /**
    * @ORM\Column(name="direccion", type="string", nullable=true)
    */
    private $direccion;

    /**
    * @ORM\Column(name="patente", type="string", length=20)
    */
    private $patente;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct(){
        $this->setEstado('reservado');
    }

    public function cancelarTurno(){
        $this->setEstado('cancelado');
    }

    public function vencerTurno(){
        $this->setEstado('vencido');
    }

    public function realizarTurno(){
        $this->setEstado('realizado');
    }
    

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TurnoPar
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     *
     * @return TurnoPar
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set monto
     *
     * @param integer $monto
     *
     * @return TurnoPar
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return integer
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set fechahoracierre
     *
     * @param \DateTime $fechahoracierre
     *
     * @return TurnoPar
     */
    public function setFechahoracierre($fechahoracierre)
    {
        $this->fechahoracierre = $fechahoracierre;

        return $this;
    }

    /**
     * Get fechahoracierre
     *
     * @return \DateTime
     */
    public function getFechahoracierre()
    {
        return $this->fechahoracierre;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return TurnoPar
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set movil
     *
     * @param boolean $movil
     *
     * @return TurnoPar
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return boolean
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set vehiculo
     *
     * @param \AppBundle\Entity\Vehiculo $vehiculo
     *
     * @return TurnoPar
     */
    public function setVehiculo(\AppBundle\Entity\Vehiculo $vehiculo)
    {
        $this->vehiculo = $vehiculo;

        return $this;
    }

    /**
     * Get vehiculo
     *
     * @return \AppBundle\Entity\Vehiculo
     */
    public function getVehiculo()
    {
        return $this->vehiculo;
    }

    /**
     * Set tipolavado
     *
     * @param \AppBundle\Entity\TipoLavado $tipolavado
     *
     * @return TurnoPar
     */
    public function setTipolavado(\AppBundle\Entity\TipoLavado $tipolavado)
    {
        $this->tipolavado = $tipolavado;

        return $this;
    }

    /**
     * Get tipolavado
     *
     * @return \AppBundle\Entity\TipoLavado
     */
    public function getTipolavado()
    {
        return $this->tipolavado;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return TurnoPar
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set centrointegral
     *
     * @param \AppBundle\Entity\CentroIntegral $centrointegral
     *
     * @return TurnoPar
     */
    public function setCentrointegral(\AppBundle\Entity\CentroIntegral $centrointegral)
    {
        $this->centrointegral = $centrointegral;

        return $this;
    }

    /**
     * Get centrointegral
     *
     * @return \AppBundle\Entity\CentroIntegral
     */
    public function getCentrointegral()
    {
        return $this->centrointegral;
    }

    /**
     * Set operario
     *
     * @param \AppBundle\Entity\Operario $operario
     *
     * @return TurnoPar
     */
    public function setOperario(\AppBundle\Entity\Operario $operario = null)
    {
        $this->operario = $operario;

        return $this;
    }

    /**
     * Get operario
     *
     * @return \AppBundle\Entity\Operario
     */
    public function getOperario()
    {
        return $this->operario;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return TurnoPar
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set patente
     *
     * @param string $patente
     *
     * @return TurnoPar
     */
    public function setPatente($patente)
    {
        $this->patente = $patente;

        return $this;
    }

    /**
     * Get patente
     *
     * @return string
     */
    public function getPatente()
    {
        return $this->patente;
    }
}
