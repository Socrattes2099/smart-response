<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\MessagesMo;
use BG\HackatonBundle\Form\MessagesMoType;

/**
 * MessagesMo controller.
 *
 * @Route("/messagesmo")
 */
class MessagesMoController extends Controller
{

    /**
     * Lists all MessagesMo entities.
     *
     * @Route("/", name="messagesmo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:MessagesMo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new MessagesMo entity.
     *
     * @Route("/", name="messagesmo_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:MessagesMo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new MessagesMo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('messagesmo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a MessagesMo entity.
    *
    * @param MessagesMo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(MessagesMo $entity)
    {
        $form = $this->createForm(new MessagesMoType(), $entity, array(
            'action' => $this->generateUrl('messagesmo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MessagesMo entity.
     *
     * @Route("/new", name="messagesmo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MessagesMo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MessagesMo entity.
     *
     * @Route("/{id}", name="messagesmo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:MessagesMo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessagesMo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MessagesMo entity.
     *
     * @Route("/{id}/edit", name="messagesmo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:MessagesMo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessagesMo entity.');
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
    * Creates a form to edit a MessagesMo entity.
    *
    * @param MessagesMo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MessagesMo $entity)
    {
        $form = $this->createForm(new MessagesMoType(), $entity, array(
            'action' => $this->generateUrl('messagesmo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MessagesMo entity.
     *
     * @Route("/{id}", name="messagesmo_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:MessagesMo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:MessagesMo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MessagesMo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('messagesmo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a MessagesMo entity.
     *
     * @Route("/{id}", name="messagesmo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:MessagesMo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MessagesMo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('messagesmo'));
    }

    /**
     * Creates a form to delete a MessagesMo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('messagesmo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
