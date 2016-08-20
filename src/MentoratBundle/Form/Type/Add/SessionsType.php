<?php

namespace MentoratBundle\Form\Type\Add;

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
                'date_widget' => 'choice',
                'format' => 'dd-MM-yyyy hh:mm',
                'model_timezone' => 'Europe/Paris',
                'invalid_message' => 'Les valeurs rentrées ne correspondent pas au format attendu !',
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
