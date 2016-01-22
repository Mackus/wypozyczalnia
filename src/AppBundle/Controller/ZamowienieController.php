<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Zamowienie;

/**
 * Zamowienie controller.
 *
 * @Route("/zamowienia")
 */
class ZamowienieController extends Controller
{
    /**
     * Lists all Zamowienie entities.
     *
     * @Route("/", name="zamowienia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $zamowienies = $em->getRepository('AppBundle:Zamowienie')->findAll();

        return $this->render('zamowienie/index.html.twig', array(
            'zamowienies' => $zamowienies,
        ));
    }

    /**
     * Finds and displays a Zamowienie entity.
     *
     * @Route("/{id}", name="zamowienia_show")
     * @Method("GET")
     */
    public function showAction(Zamowienie $zamowienie)
    {

        return $this->render('zamowienie/show.html.twig', array(
            'zamowienie' => $zamowienie,
        ));
    }
}
