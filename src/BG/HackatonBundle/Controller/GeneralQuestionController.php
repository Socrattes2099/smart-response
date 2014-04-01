<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\GeneralQuestion;
use BG\HackatonBundle\Form\GeneralQuestionType;

/**
 * GeneralQuestion controller.
 *
 * @Route("/generalquestion")
 */
class GeneralQuestionController extends Controller
{

    /**
     * Lists all GeneralQuestion entities.
     *
     * @Route("/", name="generalquestion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:GeneralQuestion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new GeneralQuestion entity.
     *
     * @Route("/", name="generalquestion_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:GeneralQuestion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new GeneralQuestion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('generalquestion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a GeneralQuestion entity.
    *
    * @param GeneralQuestion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GeneralQuestion $entity)
    {
        $form = $this->createForm(new GeneralQuestionType(), $entity, array(
            'action' => $this->generateUrl('generalquestion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GeneralQuestion entity.
     *
     * @Route("/new", name="generalquestion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GeneralQuestion();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GeneralQuestion entity.
     *
     * @Route("/{id}", name="generalquestion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:GeneralQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeneralQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GeneralQuestion entity.
     *
     * @Route("/{id}/edit", name="generalquestion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:GeneralQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeneralQuestion entity.');
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
    * Creates a form to edit a GeneralQuestion entity.
    *
    * @param GeneralQuestion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GeneralQuestion $entity)
    {
        $form = $this->createForm(new GeneralQuestionType(), $entity, array(
            'action' => $this->generateUrl('generalquestion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GeneralQuestion entity.
     *
     * @Route("/{id}", name="generalquestion_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:GeneralQuestion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:GeneralQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeneralQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('generalquestion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a GeneralQuestion entity.
     *
     * @Route("/{id}", name="generalquestion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:GeneralQuestion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GeneralQuestion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('generalquestion'));
    }

    /**
     * Creates a form to delete a GeneralQuestion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('generalquestion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
