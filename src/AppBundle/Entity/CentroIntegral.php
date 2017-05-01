<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CentroIntegral
 *
 * @ORM\Table(name="centro_integral")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CentroIntegralRepository")
 */
class CentroIntegral
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
     * @var string
     * @Assert\Type(type="integer")
     * @Assert\Length(min = 0)
     * @ORM\Column(name="operarios", type="string", length=255)
     */
    private $operarios;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="TurnoPar", mappedBy="centrointegral")
     */
    private $turnopars;


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
        $this->operarios = 9;
        $this->turnopars = new ArrayCollection();
    }

    public function __toString(){
        return 'Sucursal: ' . $this->getId() . ' Dirección: ' . $this->getDireccion();
    }


    /**
     * Set operarios
     *
     * @param string $operarios
     *
     * @return CentroIntegral
     */
    public function setOperarios($operarios)
    {
        $this->operarios = $operarios;

        return $this;
    }

    /**
     * Get operarios
     *
     * @return string
     */
    public function getOperarios()
    {
        return $this->operarios;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return CentroIntegral
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
     * Add turnopar
     *
     * @param \AppBundle\Entity\TurnoPar $turnopar
     *
     * @return CentroIntegral
     */
    public function addTurnopar(\AppBundle\Entity\TurnoPar $turnopar)
    {
        $this->turnopars[] = $turnopar;

        return $this;
    }

    /**
     * Remove turnopar
     *
     * @param \AppBundle\Entity\TurnoPar $turnopar
     */
    public function removeTurnopar(\AppBundle\Entity\TurnoPar $turnopar)
    {
        $this->turnopars->removeElement($turnopar);
    }

    /**
     * Get turnopars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTurnopars()
    {
        return $this->turnopars;
    }
}
