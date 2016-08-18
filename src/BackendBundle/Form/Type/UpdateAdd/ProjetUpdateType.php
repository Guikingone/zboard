<?php

namespace BackendBundle\Form\UpdateAdd;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetUpdateType extends AbstractType
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
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                    'Validé' => 'Validé',
                    'Soutenu' => 'Soutenu',
                    'A revoir' => 'A revoir',
                    'En retard' => 'En retard',
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
            'data_class' => 'BackendBundle\Entity\Projet',
        ));
    }

    public function getName()
    {
        return 'backend_bundle_projet_update_type';
    }
}
