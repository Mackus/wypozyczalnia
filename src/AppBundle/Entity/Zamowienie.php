<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Zamowienie
 *
 * @ORM\Table(name="zamowienie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ZamowienieRepository")
 */
class Zamowienie
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataOdbioru", type="datetime")
     */
    private $dataOdbioru;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzytkownik")
     * @ORM\JoinColumn(name="uzytkownik_id", referencedColumnName="id")
     */
    private $uzytkownik;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Samochod")
     * @ORM\JoinColumn(name="samochod_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $samochod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="utworzono", type="datetime")
     */
    private $utworzono;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

    /**
     * Zamowienie constructor.
     */
    public function __construct()
    {
        $this->utworzono = new \DateTime();
    }


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
     * Set dataOdbioru
     *
     * @param \DateTime $dataOdbioru
     *
     * @return Zamowienie
     */
    public function setDataOdbioru($dataOdbioru)
    {
        $this->dataOdbioru = $dataOdbioru;

        return $this;
    }

    /**
     * Get dataOdbioru
     *
     * @return \DateTime
     */
    public function getDataOdbioru()
    {
        return $this->dataOdbioru;
    }

    /**
     * Set uzytkownik
     *
     * @param Uzytkownik $uzytkownik
     *
     * @return Zamowienie
     */
    public function setUzytkownik($uzytkownik)
    {
        $this->uzytkownik = $uzytkownik;

        return $this;
    }

    /**
     * Get uzytkownik
     *
     * @return \stdClass
     */
    public function getUzytkownik()
    {
        return $this->uzytkownik;
    }

    /**
     * Set samochod
     *
     * @param Samochod $samochod
     *
     * @return Zamowienie
     */
    public function setSamochod($samochod)
    {
        $this->samochod = $samochod;

        return $this;
    }

    /**
     * Get samochod
     *
     * @return Samochod
     */
    public function getSamochod()
    {
        return $this->samochod;
    }

    /**
     * Set utworzono
     *
     * @param \DateTime $utworzono
     *
     * @return Zamowienie
     */
    public function setUtworzono($utworzono)
    {
        $this->utworzono = $utworzono;

        return $this;
    }

    /**
     * Get utworzono
     *
     * @return \DateTime
     */
    public function getUtworzono()
    {
        return $this->utworzono;
    }

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}

