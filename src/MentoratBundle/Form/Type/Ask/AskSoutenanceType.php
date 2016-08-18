<?php

namespace MentoratBundle\Form\Type\Ask;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AskSoutenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projet', EntityType::class, array(
                'class' => 'BackendBundle\Entity\Projet',
                'choice_label' => 'libelle',
            ))
            ->add('duree_demande', ChoiceType::class, array(
                'choices' => array(
                    '1 semaine' => '1 semaine',
                    '2 semaines' => '2 semaines',
                    '+ de 2 semaines' => '+ de 2 semaines',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MentoratBundle\Entity\Soutenance',
        ));
    }

    public function getName()
    {
        return 'mentorat_bundle_ask_soutenance_type';
    }
}
