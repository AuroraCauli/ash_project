<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CarCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Carcategory controller.
 *
 * @Route("/admin/carcategory")
 */
class CarCategoryController extends Controller
{
    /**
     * Lists all carCategory entities.
     *
     * @Route("/", name="carcategory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carCategories = $em->getRepository('AppBundle:CarCategory')->findAll();

        return $this->render('@App/carcategory/index.html.twig', array(
            'carCategories' => $carCategories,
        ));
    }

    /**
     * Creates a new carCategory entity.
     *
     * @Route("/new", name="carcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $carCategory = new Carcategory();
        $form = $this->createForm('AppBundle\Form\CarCategoryType', $carCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carCategory);
            $em->flush();

            return $this->redirectToRoute('carcategory_index');
        }

        return $this->render('@App/carcategory/new.html.twig', array(
            'carCategory' => $carCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing carCategory entity.
     *
     * @Route("/{id}/edit", name="carcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CarCategory $carCategory)
    {
        $deleteForm = $this->createDeleteForm($carCategory);
        $editForm = $this->createForm('AppBundle\Form\CarCategoryType', $carCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carcategory_edit', array('id' => $carCategory->getId()));
        }

        return $this->render('@App/carcategory/new.html.twig', array(
            'carCategory' => $carCategory,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a carCategory entity.
     *
     * @Route("/{id}", name="carcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CarCategory $carCategory)
    {
        $form = $this->createDeleteForm($carCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carCategory);
            $em->flush();
        }

        return $this->redirectToRoute('carcategory_index');
    }

    /**
     * Creates a form to delete a carCategory entity.
     *
     * @param CarCategory $carCategory The carCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CarCategory $carCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carcategory_delete', array('id' => $carCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
