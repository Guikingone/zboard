<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->remove('firstname')
            ->remove('lastname')
            ->remove('address')
            ->remove('zipcode')
            ->remove('city')
            ->remove('phone')
            ->remove('email')
            ->remove('available')
            ->remove('country')
            ->remove('plainPassword')
            ->remove('plainPassword_confirmation')
            ->remove('archived')
            ->remove('group')
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Mentore en formation' => 'ROLE_MENTOR_FORMATION',
                    'Mentor' => 'ROLE_MENTOR',
                    'Mentore expérimenté' => 'ROLE_MENTOR_EXP',
                    'Superviseur Mentors' => 'ROLE_SUPERVISEUR_MENTOR',
                    'Mentore' => 'ROLE_MENTORE',
                    'OpenClassrooms' => 'ROLE_OC',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'user_bundle_update_user_type';
    }
}
