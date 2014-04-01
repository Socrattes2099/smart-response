<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\CrimeCategories;
use BG\HackatonBundle\Form\CrimeCategoriesType;

/**
 * CrimeCategories controller.
 *
 * @Route("/crimecategories")
 */
class CrimeCategoriesController extends Controller
{

    /**
     * Lists all CrimeCategories entities.
     *
     * @Route("/", name="crimecategories")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:CrimeCategories')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CrimeCategories entity.
     *
     * @Route("/", name="crimecategories_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:CrimeCategories:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CrimeCategories();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('crimecategories_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CrimeCategories entity.
    *
    * @param CrimeCategories $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CrimeCategories $entity)
    {
        $form = $this->createForm(new CrimeCategoriesType(), $entity, array(
            'action' => $this->generateUrl('crimecategories_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CrimeCategories entity.
     *
     * @Route("/new", name="crimecategories_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CrimeCategories();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CrimeCategories entity.
     *
     * @Route("/{id}", name="crimecategories_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeCategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CrimeCategories entity.
     *
     * @Route("/{id}/edit", name="crimecategories_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeCategories entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a CrimeCategories entity.
    *
    * @param CrimeCategories $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CrimeCategories $entity)
    {
        $form = $this->createForm(new CrimeCategoriesType(), $entity, array(
            'action' => $this->generateUrl('crimecategories_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CrimeCategories entity.
     *
     * @Route("/{id}", name="crimecategories_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:CrimeCategories:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeCategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('crimecategories_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CrimeCategories entity.
     *
     * @Route("/{id}", name="crimecategories_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:CrimeCategories')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CrimeCategories entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('crimecategories'));
    }

    /**
     * Creates a form to delete a CrimeCategories entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crimecategories_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
