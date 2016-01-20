<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Samochod
 *
 * @ORM\Table(name="samochod")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SamochodRepository")
 */
class Samochod
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
     * @ORM\Column(name="nazwa", type="string", length=255)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="text")
     */
    private $opis;

    /**
     * @var int
     *
     * @ORM\Column(name="rokProdukcji", type="integer")
     */
    private $rokProdukcji;

    /**
     * @var string
     *
     * @ORM\Column(name="kosztWynajmu", type="decimal", precision=10, scale=0)
     */
    private $kosztWynajmu;

    /**
     * @var int
     *
     * @ORM\Column(name="dostepnychSztuk", type="integer")
     */
    private $dostepnychSztuk;


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
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return Samochod
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return Samochod
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set rokProdukcji
     *
     * @param integer $rokProdukcji
     *
     * @return Samochod
     */
    public function setRokProdukcji($rokProdukcji)
    {
        $this->rokProdukcji = $rokProdukcji;

        return $this;
    }

    /**
     * Get rokProdukcji
     *
     * @return int
     */
    public function getRokProdukcji()
    {
        return $this->rokProdukcji;
    }

    /**
     * Set kosztWynajmu
     *
     * @param string $kosztWynajmu
     *
     * @return Samochod
     */
    public function setKosztWynajmu($kosztWynajmu)
    {
        $this->kosztWynajmu = $kosztWynajmu;

        return $this;
    }

    /**
     * Get kosztWynajmu
     *
     * @return string
     */
    public function getKosztWynajmu()
    {
        return $this->kosztWynajmu;
    }

    /**
     * Set dostepnychSztuk
     *
     * @param integer $dostepnychSztuk
     *
     * @return Samochod
     */
    public function setDostepnychSztuk($dostepnychSztuk)
    {
        $this->dostepnychSztuk = $dostepnychSztuk;

        return $this;
    }

    /**
     * Get dostepnychSztuk
     *
     * @return int
     */
    public function getDostepnychSztuk()
    {
        return $this->dostepnychSztuk;
    }
}

