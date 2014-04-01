<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\CrimeQuestions;
use BG\HackatonBundle\Form\CrimeQuestionsType;

/**
 * CrimeQuestions controller.
 *
 * @Route("/crimequestions")
 */
class CrimeQuestionsController extends Controller
{

    /**
     * Lists all CrimeQuestions entities.
     *
     * @Route("/", name="crimequestions")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:CrimeQuestions')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CrimeQuestions entity.
     *
     * @Route("/", name="crimequestions_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:CrimeQuestions:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CrimeQuestions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('crimequestions_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CrimeQuestions entity.
    *
    * @param CrimeQuestions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CrimeQuestions $entity)
    {
        $form = $this->createForm(new CrimeQuestionsType(), $entity, array(
            'action' => $this->generateUrl('crimequestions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CrimeQuestions entity.
     *
     * @Route("/new", name="crimequestions_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CrimeQuestions();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CrimeQuestions entity.
     *
     * @Route("/{id}", name="crimequestions_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeQuestions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeQuestions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CrimeQuestions entity.
     *
     * @Route("/{id}/edit", name="crimequestions_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeQuestions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeQuestions entity.');
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
    * Creates a form to edit a CrimeQuestions entity.
    *
    * @param CrimeQuestions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CrimeQuestions $entity)
    {
        $form = $this->createForm(new CrimeQuestionsType(), $entity, array(
            'action' => $this->generateUrl('crimequestions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CrimeQuestions entity.
     *
     * @Route("/{id}", name="crimequestions_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:CrimeQuestions:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeQuestions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeQuestions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('crimequestions_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CrimeQuestions entity.
     *
     * @Route("/{id}", name="crimequestions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:CrimeQuestions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CrimeQuestions entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('crimequestions'));
    }

    /**
     * Creates a form to delete a CrimeQuestions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crimequestions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
