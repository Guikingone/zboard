<?php

namespace MentoratBundle\Form;

use BackendBundle\Form\FinancementType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MentoreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address', TextType::class)
            ->add('zipcode', TextType::class)
            ->add('city', TextType::class)
            ->add('country', CountryType::class)
            ->add('email', EmailType::class)
            ->add('phone', TextType::class)
            ->add('resume', TextareaType::class)
            ->add('parcours', EntityType::class, array(
                'class' => 'BackendBundle\Entity\Parcours',
                'choice_label' => 'libelle',
            ))
            ->add('date_start', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd-MM-yyyy',
            ))
            ->add('financement', FinancementType::class)
            ->add('status', ChoiceType::class, array(
                'choices' => [
                    'En attente de prise de contact' => 'En attente',
                    'Contacté' => 'Contacté',
                    'En formation' => 'En formation',
                    'En pause' => 'En pause',
                    'Formation terminée' => 'Formation terminé',
                ],
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MentoratBundle\Entity\Mentore',
        ));
    }
}
