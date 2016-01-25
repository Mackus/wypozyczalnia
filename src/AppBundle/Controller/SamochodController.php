<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Samochod;
use AppBundle\Form\SamochodType;

/**
 * Samochod controller.
 *
 * @Route("/samochody")
 */
class SamochodController extends Controller
{
    /**
     * Lists all Samochod entities.
     *
     * @Route("/", name="samochody_index")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($category = $request->get('category'))
        {
            $samochods = $em->getRepository('AppBundle:Samochod')->findBy(['kategoria' => $category]);

        } else {
            $samochods = $em->getRepository('AppBundle:Samochod')->findAll();
        }


        return $this->render('samochod/index.html.twig', array(
            'samochods' => $samochods,
            'kategorie' => $em->getRepository('AppBundle:Samochod')->createQueryBuilder('s')->select('s.kategoria')->getQuery()->execute()
    ));
    }

    /**
     * Creates a new Samochod entity.
     *
     * @Route("/new", name="samochody_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $samochod = new Samochod();
        $form = $this->createForm('AppBundle\Form\SamochodType', $samochod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($samochod);
            $em->flush();

            return $this->redirectToRoute('samochody_show', array('id' => $samochod->getId()));
        }

        return $this->render('samochod/new.html.twig', array(
            'samochod' => $samochod,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Samochod entity.
     *
     * @Route("/{id}", name="samochody_show")
     * @Method("GET")
     */
    public function showAction(Samochod $samochod)
    {
        $deleteForm = $this->createDeleteForm($samochod);

        return $this->render('samochod/show.html.twig', array(
            'samochod' => $samochod,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Samochod entity.
     *
     * @Route("/{id}/edit", name="samochody_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Samochod $samochod)
    {
        $deleteForm = $this->createDeleteForm($samochod);
        $editForm = $this->createForm('AppBundle\Form\SamochodType', $samochod);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($samochod);
            $em->flush();

            return $this->redirectToRoute('samochody_edit', array('id' => $samochod->getId()));
        }

        return $this->render('samochod/edit.html.twig', array(
            'samochod' => $samochod,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Samochod entity.
     *
     * @Route("/{id}", name="samochody_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Samochod $samochod)
    {
        $form = $this->createDeleteForm($samochod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($samochod);
            $em->flush();
        }

        return $this->redirectToRoute('samochody_index');
    }

    /**
     * Creates a form to delete a Samochod entity.
     *
     * @param Samochod $samochod The Samochod entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Samochod $samochod)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('samochody_delete', array('id' => $samochod->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
