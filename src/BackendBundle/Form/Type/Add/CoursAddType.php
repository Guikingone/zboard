<?php

namespace BackendBundle\Form\Type\Add;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursAddType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextareaType::class)
            ->add('duree', TextType::class)
            ->add('difficulty', ChoiceType::class, array(
                'choices' => array(
                    'Facile' => 'Facile',
                    'Moyenne' => 'Moyenne',
                    'Difficile' => 'Difficile',
                ),
            ))
            ->remove('status')
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
}
