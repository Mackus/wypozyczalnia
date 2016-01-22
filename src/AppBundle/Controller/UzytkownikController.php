<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Uzytkownik;
use AppBundle\Form\UzytkownikType;

/**
 * Uzytkownik controller.
 *
 * @Route("/uzytkownicy")
 */
class UzytkownikController extends Controller
{
    /**
     * Lists all Uzytkownik entities.
     *
     * @Route("/", name="uzytkownicy_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $uzytkowniks = $em->getRepository('AppBundle:Uzytkownik')->findAll();

        return $this->render('uzytkownik/index.html.twig', array(
            'uzytkowniks' => $uzytkowniks,
        ));
    }

    /**
     * Creates a new Uzytkownik entity.
     *
     * @Route("/new", name="uzytkownicy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $uzytkownik = new Uzytkownik();
        $form = $this->createForm('AppBundle\Form\UzytkownikType', $uzytkownik);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($uzytkownik);
            $em->flush();

            return $this->redirectToRoute('uzytkownicy_show', array('id' => $uzytkownik->getId()));
        }

        return $this->render('uzytkownik/new.html.twig', array(
            'uzytkownik' => $uzytkownik,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Uzytkownik entity.
     *
     * @Route("/{id}", name="uzytkownicy_show")
     * @Method("GET")
     */
    public function showAction(Uzytkownik $uzytkownik)
    {
        $deleteForm = $this->createDeleteForm($uzytkownik);

        return $this->render('uzytkownik/show.html.twig', array(
            'uzytkownik' => $uzytkownik,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Uzytkownik entity.
     *
     * @Route("/{id}/edit", name="uzytkownicy_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Uzytkownik $uzytkownik)
    {
        $deleteForm = $this->createDeleteForm($uzytkownik);
        $editForm = $this->createForm('AppBundle\Form\UzytkownikType', $uzytkownik);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($uzytkownik);
            $em->flush();

            return $this->redirectToRoute('uzytkownicy_edit', array('id' => $uzytkownik->getId()));
        }

        return $this->render('uzytkownik/edit.html.twig', array(
            'uzytkownik' => $uzytkownik,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Uzytkownik entity.
     *
     * @Route("/{id}", name="uzytkownicy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Uzytkownik $uzytkownik)
    {
        $form = $this->createDeleteForm($uzytkownik);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($uzytkownik);
            $em->flush();
        }

        return $this->redirectToRoute('uzytkownicy_index');
    }

    /**
     * Creates a form to delete a Uzytkownik entity.
     *
     * @param Uzytkownik $uzytkownik The Uzytkownik entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Uzytkownik $uzytkownik)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('uzytkownicy_delete', array('id' => $uzytkownik->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
