<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operario
 *
 * @ORM\Table(name="operario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OperarioRepository")
 */
class Operario
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
     * @ORM\Column(name="centrointegral", type="string", length=255)
     */
    private $centrointegral;

    /**
    * @var string
    * @ORM\OneToMany(targetEntity="TurnoPar", mappedBy="operario")
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


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->turnopars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set centrointegral
     *
     * @param string $centrointegral
     *
     * @return Operario
     */
    public function setCentrointegral($centrointegral)
    {
        $this->centrointegral = $centrointegral;

        return $this;
    }

    /**
     * Get centrointegral
     *
     * @return string
     */
    public function getCentrointegral()
    {
        return $this->centrointegral;
    }

    /**
     * Add turnopar
     *
     * @param \AppBundle\Entity\TurnoPar $turnopar
     *
     * @return Operario
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
