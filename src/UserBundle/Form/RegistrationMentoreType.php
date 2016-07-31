<?php

namespace UserBundle\Form;

use MentoratBundle\Form\SuiviType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationMentoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address', TextType::class)
            ->add('zipcode', TextType::class)
            ->add('city', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('resume', TextareaType::class)
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
            ->add('suivi', SuiviType::class)
            ->remove('sessions')
            ->remove('soutenances')
            ->remove('plainPassword')
            ->remove('plainPassword_confirmation')
            ->remove('archived')
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_mentore_registration';
    }
}
