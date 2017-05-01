<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->turnos = new ArrayCollection();
    }

    /**
     * @var apellido
     *
     * @ORM\Column(name="apellido", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $apellido;

    /**
     * @var nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var dni
     * @Assert\Length(min = 13,max = 13)
     * @ORM\Column(name="dni", type="string", length=13)
     */
    private $dni;

    /**
     * @var direccion
     *
     * @ORM\Column(name="direccion", type="string", length=200)
     */
    private $direccion;

    /**
     * @var telefono
     * @Assert\Type(type="integer")
     * @Assert\Length(min = 8,max = 20)
     * @ORM\Column(name="telefono", type="string", length=20)
     */
    private $telefono;

    /**
     * @var sexo
     *
     * @ORM\Column(name="sexo", type="string", length=20, nullable=true)
     * @Assert\Choice(
     *     choices = { "masculino", "femenino"},
     *     message = "Selecciona una opción correcta")
     */
    private $sexo;

    /**
     * @var tipo
     *
     * @ORM\Column(name="tipo", type="string", length=100)
     */
    private $tipo;

     /**
     * @ORM\OneToMany(targetEntity="TurnoPar", mappedBy="user")
     * @ORM\OrderBy({"fecha" = "ASC", "hora" = "ASC"}) 
     */
    private $turnos;

    /**
     * @ORM\OneToMany(targetEntity="Plan", mappedBy="user")
     */
    private $planes;


    public function getTurnos(){
        return $this->turnos;
    }

    public function setTurno($turno){
        $this->turnos->add($turno);
        return $this;
    }

    public function getPlanes(){
        return $this->planes;
    }

    public function setPlan($plan){
        $this->plan->add($plan);
        return $this;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return User
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return User
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return User
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return User
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return User
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return User
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return User
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
