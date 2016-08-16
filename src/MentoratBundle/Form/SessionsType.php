<?php

namespace MentoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('libelle')
            ->add('dateSession', DateTimeType::class, array(
                'format' => 'dd-MM-yyyy hh-mm',
                'html5' => false,
                'widget' => 'single_text',
            ))
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    'Planifiée' => 'Planifiee',
                    'Présent' => 'Present',
                    'Absent' => 'Absent',
                    'Annulée' => 'Annulee',
                    'No Show' => 'No show',
                ),
            ))
            ->add('periodicity', ChoiceType::class, array(
                'choices' => array(
                    'Oui' => true,
                    'Non' => false,
                ),
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MentoratBundle\Entity\Sessions',
        ));
    }
}
