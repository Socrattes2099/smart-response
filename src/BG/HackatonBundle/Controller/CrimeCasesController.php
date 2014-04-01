<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\CrimeCases;
use BG\HackatonBundle\Form\CrimeCasesType;

/**
 * CrimeCases controller.
 *
 * @Route("/crimecases")
 */
class CrimeCasesController extends Controller
{

    /**
     * Lists all CrimeCases entities.
     *
     * @Route("/", name="crimecases")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:CrimeCases')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CrimeCases entity.
     *
     * @Route("/", name="crimecases_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:CrimeCases:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CrimeCases();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('crimecases_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CrimeCases entity.
    *
    * @param CrimeCases $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CrimeCases $entity)
    {
        $form = $this->createForm(new CrimeCasesType(), $entity, array(
            'action' => $this->generateUrl('crimecases_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CrimeCases entity.
     *
     * @Route("/new", name="crimecases_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CrimeCases();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CrimeCases entity.
     *
     * @Route("/{id}", name="crimecases_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeCases')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeCases entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CrimeCases entity.
     *
     * @Route("/{id}/edit", name="crimecases_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeCases')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeCases entity.');
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
    * Creates a form to edit a CrimeCases entity.
    *
    * @param CrimeCases $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CrimeCases $entity)
    {
        $form = $this->createForm(new CrimeCasesType(), $entity, array(
            'action' => $this->generateUrl('crimecases_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CrimeCases entity.
     *
     * @Route("/{id}", name="crimecases_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:CrimeCases:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeCases')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeCases entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('crimecases_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CrimeCases entity.
     *
     * @Route("/{id}", name="crimecases_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:CrimeCases')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CrimeCases entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('crimecases'));
    }

    /**
     * Creates a form to delete a CrimeCases entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crimecases_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
