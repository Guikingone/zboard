<?php

namespace MentoratBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('date_start', DateType::class, array(
                'html5' => false,
                'format' => 'dd-MM-yyyy',
                'widget' => 'single_text',
            ))
            ->remove('dUpdate')
            ->add('parcours', EntityType::class, array(
                'class' => 'BackendBundle\Entity\Parcours',
                'choice_label' => 'libelle',
            ))
            ->add('mentor', EntityType::class, array(
                'class' => 'UserBundle\Entity\User',
                'choice_label' => 'lastname',
            ))
            ->add('financement', ChoiceType::class, array(
                'choices' => array(
                    'Oui' => true,
                    'Non' => false,
                ),
            ))
            ->add('financeur', TextType::class, array(
                'required' => false,
            ))
            ->add('duree_financement', TextType::class, array(
                'required' => false,
            ))
            ->remove('mentore')
            ->add('suivi_state', ChoiceType::class, array(
                'choices' => array(
                    'En attente' => 'WAITING_LIST',
                    'En cours' => 'IN_PROGRESS',
                    'Mentorat terminé' => 'ENDED',
                ),
            ))
            ->add('mentore_status', ChoiceType::class, array(
                'choices' => array(
                    'En attente' => 'En attente',
                    'Contacté' => 'Contacté',
                    'En formation' => 'En formation',
                    'En pause' => 'En pause',
                    'Formation terminée' => 'Formation terminée',
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
