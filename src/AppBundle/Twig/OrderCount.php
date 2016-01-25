<?php
namespace AppBundle\Twig;

use AppBundle\Entity\Samochod;
use Doctrine\ORM\EntityManager;

class OrderCount extends \Twig_Extension
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('get_order_count', array($this, 'orderCount')),
        );
    }

    /**
     * @param Samochod $samochod
     * @return string
     */
    public function orderCount(Samochod $samochod)
    {
        $orders = $this->em->getRepository('AppBundle:Zamowienie')->findBy(['samochod' => $samochod->getId()]);
        return count($orders);
    }

    public function getName()
    {
        return 'app_extension';
    }
}