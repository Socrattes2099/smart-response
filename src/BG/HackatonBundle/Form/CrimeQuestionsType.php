<?php

namespace BG\HackatonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CrimeQuestionsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question')
            ->add('questionNumber')
            ->add('type')
            ->add('crimeCategory')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BG\HackatonBundle\Entity\CrimeQuestions'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bg_hackatonbundle_crimequestions';
    }
}
