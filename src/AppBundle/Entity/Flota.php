<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Flota
 *
 * @ORM\Table(name="flota")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FlotaRepository")
 */
class Flota
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
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     * @Assert\GreaterThan(value=0)
     */
    private $cantidad;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Vehiculo")
     * @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id", nullable=false)
     */
    private $tipovehiculo;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="TipoLavado")
     * @ORM\JoinColumn(name="tipolavado_id", referencedColumnName="id", nullable=false)
     */
    private $tipolavado;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="CentroIntegral")
     * @ORM\JoinColumn(name="centrointegral_id", referencedColumnName="id", nullable=false)
     */
    private $centrointegral;

    /**
     * @var string
     *
     * @ORM\Column(name="periodicidad", type="string", length=255)
     */
    private $periodicidad;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Plan", inversedBy="flotas")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     */
    private $plan;

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Flota
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set periodicidad
     *
     * @param string $periodicidad
     *
     * @return Flota
     */
    public function setPeriodicidad($periodicidad)
    {
        $this->periodicidad = $periodicidad;

        return $this;
    }

    /**
     * Get periodicidad
     *
     * @return string
     */
    public function getPeriodicidad()
    {
        return $this->periodicidad;
    }

    /**
     * Set tipovehiculo
     *
     * @param \AppBundle\Entity\Vehiculo $tipovehiculo
     *
     * @return Flota
     */
    public function setTipovehiculo(\AppBundle\Entity\Vehiculo $tipovehiculo)
    {
        $this->tipovehiculo = $tipovehiculo;

        return $this;
    }

    /**
     * Get tipovehiculo
     *
     * @return \AppBundle\Entity\Vehiculo
     */
    public function getTipovehiculo()
    {
        return $this->tipovehiculo;
    }

    /**
     * Set tipolavado
     *
     * @param \AppBundle\Entity\TipoLavado $tipolavado
     *
     * @return Flota
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
     * Set centrointegral
     *
     * @param \AppBundle\Entity\CentroIntegral $centrointegral
     *
     * @return Flota
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
     * Set plan
     *
     * @param \AppBundle\Entity\Plan $plan
     *
     * @return Flota
     */
    public function setPlan(\AppBundle\Entity\Plan $plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return \AppBundle\Entity\Plan
     */
    public function getPlan()
    {
        return $this->plan;
    }
}
