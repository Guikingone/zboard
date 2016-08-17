<?php

namespace BackendBundle\Form\Add;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcoursAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('diplome', TextType::class, array(
                'required' => false,
            ))
            ->add('abonnement', EntityType::class, array(
                'class' => 'BackendBundle\Entity\Abonnement',
                'choice_label' => 'libelle',
            ))
            ->remove('date_start')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Parcours',
        ));
    }

    public function getName()
    {
        return 'backend_bundle_parcours_type_add';
    }
}
