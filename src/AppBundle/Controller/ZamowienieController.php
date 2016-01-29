<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Samochod;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Zamowienie;
use Symfony\Component\HttpFoundation\Request;

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

        if ($this->isGranted('ROLE_ADMIN')) {
            $zamowienies = $em->getRepository('AppBundle:Zamowienie')->findAll();
        } else {
            $zamowienies = $em->getRepository('AppBundle:Zamowienie')->findBy(['uzytkownik' => $this->getUser()]);
        }

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

    /**
     * Finds and displays a Zamowienie entity.
     *
     * @Route("/status/{id}/{status}", name="zamowienie_status")
     * @Method("GET")
     * @param Zamowienie $zamowienie
     * @param $status
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Samochod $samochod
     */
    public function statusAction(Zamowienie $zamowienie, $status)
    {
        $zamowienie->setStatus($status);
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', 'Pomyslnie zmieniono status zamówienia');

        $zamowienie->getSamochod()->setDostepnychSztuk($zamowienie->getSamochod()->getDostepnychSztuk()+1);
        $em->flush();

        return $this->redirectToRoute('zamowienia_index');
    }

    /**
     * Finds and displays a Zamowienie entity.
     *
     * @Route("/wynajmij/{id}", name="zamowienie_new")
     * @Method("GET")
     * @param Samochod $samochod
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, Samochod $samochod)
    {
        $zamowienie = new Zamowienie();
        $zamowienie->setSamochod($samochod);
        $zamowienie->setUzytkownik($this->getUser());
        $zamowienie->setDataOdbioru(new \DateTime($request->get('dataOdbioru')));

        if ($samochod->getDostepnychSztuk() > 0) {
            $samochod->setDostepnychSztuk($samochod->getDostepnychSztuk()-1);
            $em = $this->getDoctrine()->getManager();
            $this->addFlash('success', 'Pomyslnie złożyłeś zamówienie');

            $em->persist($zamowienie);
            $em->flush();

            return $this->redirectToRoute('zamowienia_index');

        }

        $this->addFlash('danger', 'Niestety brak wolnych pojazdów');

        return $this->render('samochod/show.html.twig', array(
            'samochod' => $samochod,
        ));
    }
}
