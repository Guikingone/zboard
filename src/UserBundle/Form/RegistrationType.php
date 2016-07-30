<?php

namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address', TextType::class)
            ->add('zipcode', TextType::class)
            ->add('city', TextType::class)
            ->add('phone', TextType::class)
            ->remove('username')
            ->add('available', ChoiceType::class, array(
                'choices' => array(
                    'Oui' => true,
                    'Non' => false,
                ),
            ))
            ->add('country', EntityType::class, array(
                'class' => 'AdminBundle\Entity\Country',
                'choice_label' => 'libelle',
            ))
            ->remove('plainPassword')
            ->remove('plainPassword_confirmation')
            ->remove('archived');
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return 'user_bundle_registration_type';
    }
}
