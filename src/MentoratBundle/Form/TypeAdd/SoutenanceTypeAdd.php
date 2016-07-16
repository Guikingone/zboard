<?php

namespace MentoratBundle\Form\TypeAdd;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoutenanceTypeAdd extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('passedAt')
            ->add('mentor', EntityType::class, array(
                'class'        => 'UserBundle\Entity\User',
                'choice_label' => 'lastname',
            ))
            ->add('mentore', EntityType::class, array(
                'class'        => 'MentoratBundle\Entity\Mentore',
                'choice_label' => 'lastname',
            ))
            ->add('projet', EntityType::class, array(
                'class'        => 'BackendBundle\Entity\Projet',
                'choice_label' => 'libelle',
            ))
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    'En attente' => 'En attente',
                    'En cours'   => 'En cours',
                    'Validé'     => 'Validé',
                    'A revoir'   => 'A revoir',
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
            'data_class' => 'MentoratBundle\Entity\Soutenance'
        ));
    }
}
