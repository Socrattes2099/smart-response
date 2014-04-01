<?php

namespace BG\HackatonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CrimeQuestionAnswersType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer')
            ->add('crimeCases')
            ->add('crimeQuestions')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BG\HackatonBundle\Entity\CrimeQuestionAnswers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bg_hackatonbundle_crimequestionanswers';
    }
}
