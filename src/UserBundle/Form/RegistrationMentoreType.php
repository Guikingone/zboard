<?php

namespace UserBundle\Form;

use MentoratBundle\Form\SuiviType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationMentoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address', TextType::class, array(
                'required' => false,
            ))
            ->add('zipcode', TextType::class, array(
                'required' => false,
            ))
            ->add('city', TextType::class, array(
                'required' => false,
            ))
            ->add('phone', TextType::class, array(
                'required' => false,
            ))
            ->add('email', EmailType::class)
            ->add('resume', TextareaType::class, array(
                'required' => false,
            ))
            ->remove('available')
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
            ->remove('group')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Mentore',
        ));
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
