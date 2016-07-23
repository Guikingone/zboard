<?php

namespace MentoratBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiviType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('libelle')
            ->remove('dUpdate')
            ->add('mentor', EntityType::class, array(
                'class' => 'UserBundle\Entity\User',
                'choice_label' => 'lastName',
            ))
            ->remove('mentore')
            ->add('state', ChoiceType::class, array(
                'choices' => array(
                    'WAITING_LIST' => 'En attente',
                    'IN_PROGRESS' => 'En cours',
                    'TRANSFERT_IN_PROGRESS' => 'Transfert en cours',
                    'TRANSFERT_FINISHED' => 'Transfert terminé',
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
            'data_class' => 'MentoratBundle\Entity\Suivi',
        ));
    }
}
