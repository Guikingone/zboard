<?php

namespace UserBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('roles', CollectionType::class, array(
                'allow_add' => true,
                'allow_delete' => true,
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
