<?php

namespace BG\HackatonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BG\HackatonBundle\Entity\CaseComments;
use BG\HackatonBundle\Form\CaseCommentsType;

/**
 * CaseComments controller.
 *
 * @Route("/casecomments")
 */
class CaseCommentsController extends Controller
{

    /**
     * Lists all CaseComments entities.
     *
     * @Route("/", name="casecomments")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BGHackatonBundle:CaseComments')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CaseComments entity.
     *
     * @Route("/", name="casecomments_create")
     * @Method("POST")
     * @Template("BGHackatonBundle:CaseComments:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CaseComments();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('casecomments_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CaseComments entity.
    *
    * @param CaseComments $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CaseComments $entity)
    {
        $form = $this->createForm(new CaseCommentsType(), $entity, array(
            'action' => $this->generateUrl('casecomments_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CaseComments entity.
     *
     * @Route("/new", name="casecomments_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CaseComments();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CaseComments entity.
     *
     * @Route("/{id}", name="casecomments_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CaseComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CaseComments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CaseComments entity.
     *
     * @Route("/{id}/edit", name="casecomments_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CaseComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CaseComments entity.');
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
    * Creates a form to edit a CaseComments entity.
    *
    * @param CaseComments $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CaseComments $entity)
    {
        $form = $this->createForm(new CaseCommentsType(), $entity, array(
            'action' => $this->generateUrl('casecomments_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CaseComments entity.
     *
     * @Route("/{id}", name="casecomments_update")
     * @Method("PUT")
     * @Template("BGHackatonBundle:CaseComments:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BGHackatonBundle:CaseComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CaseComments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('casecomments_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CaseComments entity.
     *
     * @Route("/{id}", name="casecomments_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BGHackatonBundle:CaseComments')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CaseComments entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('casecomments'));
    }

    /**
     * Creates a form to delete a CaseComments entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('casecomments_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
