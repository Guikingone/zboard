<?php

namespace MentoratBundle\Form\Type\Update;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiviUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mentor', EntityType::class, array(
                'class' => 'UserBundle\Entity\User',
                'choice_label' => 'lastname',
            ))
            ->add('suivi_state', ChoiceType::class, array(
                'choices' => array(
                    'En attente' => 'WAITING_LIST',
                    'En cours' => 'IN_PROGRESS',
                    'Mentorat terminé' => 'ENDED',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MentoratBundle\Entity\Suivi',
        ));
    }

    public function getName()
    {
        return 'mentorat_bundle_suivi_update_type';
    }
}
