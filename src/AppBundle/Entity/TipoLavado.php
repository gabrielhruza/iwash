<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoLavado
 *
 * @ORM\Table(name="tipolavado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoLavadoRepository")
 */
class TipoLavado
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="string", length=255)
     */
    private $precio;

    /**
     * @ORM\OneToMany(targetEntity="TurnoPar", mappedBy="tipolavado")
     */
    private $parturnos;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct() {
        $this->parturnos = new ArrayCollection();
    }

    public function __toString(){
        return $this->getNombre();
    }

    

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoLavado
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TipoLavado
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return TipoLavado
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Add parturno
     *
     * @param \AppBundle\Entity\TurnoPar $parturno
     *
     * @return TipoLavado
     */
    public function addParturno(\AppBundle\Entity\TurnoPar $parturno)
    {
        $this->parturnos[] = $parturno;

        return $this;
    }

    /**
     * Remove parturno
     *
     * @param \AppBundle\Entity\TurnoPar $parturno
     */
    public function removeParturno(\AppBundle\Entity\TurnoPar $parturno)
    {
        $this->parturnos->removeElement($parturno);
    }

    /**
     * Get parturnos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParturnos()
    {
        return $this->parturnos;
    }
}
