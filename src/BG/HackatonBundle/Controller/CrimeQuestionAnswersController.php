<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\CrimeQuestionAnswers;
use BG\HackatonBundle\Form\CrimeQuestionAnswersType;

/**
 * CrimeQuestionAnswers controller.
 *
 * @Route("/crimequestionanswers")
 */
class CrimeQuestionAnswersController extends Controller
{

    /**
     * Lists all CrimeQuestionAnswers entities.
     *
     * @Route("/", name="crimequestionanswers")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:CrimeQuestionAnswers')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CrimeQuestionAnswers entity.
     *
     * @Route("/", name="crimequestionanswers_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:CrimeQuestionAnswers:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CrimeQuestionAnswers();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('crimequestionanswers_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CrimeQuestionAnswers entity.
    *
    * @param CrimeQuestionAnswers $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CrimeQuestionAnswers $entity)
    {
        $form = $this->createForm(new CrimeQuestionAnswersType(), $entity, array(
            'action' => $this->generateUrl('crimequestionanswers_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CrimeQuestionAnswers entity.
     *
     * @Route("/new", name="crimequestionanswers_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CrimeQuestionAnswers();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CrimeQuestionAnswers entity.
     *
     * @Route("/{id}", name="crimequestionanswers_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeQuestionAnswers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeQuestionAnswers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CrimeQuestionAnswers entity.
     *
     * @Route("/{id}/edit", name="crimequestionanswers_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeQuestionAnswers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeQuestionAnswers entity.');
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
    * Creates a form to edit a CrimeQuestionAnswers entity.
    *
    * @param CrimeQuestionAnswers $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CrimeQuestionAnswers $entity)
    {
        $form = $this->createForm(new CrimeQuestionAnswersType(), $entity, array(
            'action' => $this->generateUrl('crimequestionanswers_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CrimeQuestionAnswers entity.
     *
     * @Route("/{id}", name="crimequestionanswers_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:CrimeQuestionAnswers:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CrimeQuestionAnswers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CrimeQuestionAnswers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('crimequestionanswers_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CrimeQuestionAnswers entity.
     *
     * @Route("/{id}", name="crimequestionanswers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:CrimeQuestionAnswers')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CrimeQuestionAnswers entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('crimequestionanswers'));
    }

    /**
     * Creates a form to delete a CrimeQuestionAnswers entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crimequestionanswers_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
