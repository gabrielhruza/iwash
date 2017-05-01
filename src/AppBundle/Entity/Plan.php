<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanRepository")
 */
class Plan
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
     *
     * @ORM\OneToMany(targetEntity="Flota", mappedBy="plan", cascade={"persist", "remove"},orphanRemoval=true)
     * @Assert\Valid
     */
    private $flotas;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="monto", type="integer")
     */
    private $monto;

     /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="planes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * Constructor
     */
    public function __construct()
    {
        $this->flotas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->monto = 0;
    }

    public function calcularMonto(){
        $monto = 0;
        foreach ($this->getFlotas() as $flota) {
            $monto += ( $flota->getCantidad() )*( $flota->getTipoVehiculo()->getPrecio() + $flota->getTipoLavado()->getPrecio() );
        }
        $this->setMonto($monto);
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Plan
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
     * Set monto
     *
     * @param integer $monto
     *
     * @return Plan
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
     * Add flota
     *
     * @param \AppBundle\Entity\Flota $flota
     *
     * @return Plan
     */
    public function addFlota(\AppBundle\Entity\Flota $flota)
    {
        $this->flotas[] = $flota;

        return $this;
    }

    /**
     * Remove flota
     *
     * @param \AppBundle\Entity\Flota $flota
     */
    public function removeFlota(\AppBundle\Entity\Flota $flota)
    {
        $this->flotas->removeElement($flota);
    }

    /**
     * Get flotas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFlotas()
    {
        return $this->flotas;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Plan
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
}
