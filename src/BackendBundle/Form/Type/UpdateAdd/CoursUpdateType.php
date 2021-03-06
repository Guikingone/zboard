<?php

namespace BackendBundle\Form\Type\UpdateAdd;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursUpdateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('libelle')
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    'En attente' => 'En attente',
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                ),
            ))
            ->remove('parcours')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Cours',
        ));
    }

    public function getName()
    {
        return 'backend_bundle_cours_update_type';
    }
}
