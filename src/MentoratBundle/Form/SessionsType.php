<?php

namespace MentoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('dateSession', DateType::class, array(
                'format' => 'dd-MM-yyyy',
                'html5' => false,
                'widget' => 'single_text',
                'placeholder' => 'Ex : 31-05-2016',
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
