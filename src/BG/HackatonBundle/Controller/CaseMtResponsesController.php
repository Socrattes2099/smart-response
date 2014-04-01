<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\CaseMtResponses;
use BG\HackatonBundle\Form\CaseMtResponsesType;

/**
 * CaseMtResponses controller.
 *
 * @Route("/casemtresponses")
 */
class CaseMtResponsesController extends Controller
{

    /**
     * Lists all CaseMtResponses entities.
     *
     * @Route("/", name="casemtresponses")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:CaseMtResponses')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CaseMtResponses entity.
     *
     * @Route("/", name="casemtresponses_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:CaseMtResponses:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CaseMtResponses();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('casemtresponses_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CaseMtResponses entity.
    *
    * @param CaseMtResponses $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CaseMtResponses $entity)
    {
        $form = $this->createForm(new CaseMtResponsesType(), $entity, array(
            'action' => $this->generateUrl('casemtresponses_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CaseMtResponses entity.
     *
     * @Route("/new", name="casemtresponses_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CaseMtResponses();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CaseMtResponses entity.
     *
     * @Route("/{id}", name="casemtresponses_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CaseMtResponses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CaseMtResponses entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CaseMtResponses entity.
     *
     * @Route("/{id}/edit", name="casemtresponses_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CaseMtResponses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CaseMtResponses entity.');
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
    * Creates a form to edit a CaseMtResponses entity.
    *
    * @param CaseMtResponses $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CaseMtResponses $entity)
    {
        $form = $this->createForm(new CaseMtResponsesType(), $entity, array(
            'action' => $this->generateUrl('casemtresponses_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CaseMtResponses entity.
     *
     * @Route("/{id}", name="casemtresponses_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:CaseMtResponses:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CaseMtResponses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CaseMtResponses entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('casemtresponses_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CaseMtResponses entity.
     *
     * @Route("/{id}", name="casemtresponses_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:CaseMtResponses')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CaseMtResponses entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('casemtresponses'));
    }

    /**
     * Creates a form to delete a CaseMtResponses entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('casemtresponses_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
