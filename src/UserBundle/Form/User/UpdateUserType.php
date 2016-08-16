<?php

namespace UserBundle\Form\User;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Form\CompetencesTypeAdd;

class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address', TextareaType::class)
            ->add('zipcode')
            ->add('city')
            ->add('phone')
            ->add('email', EmailType::class)
            ->add('available', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('country', EntityType::class, [
                'class' => 'AdminBundle\Entity\Country',
                'choice_label' => 'libelle',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => 'Symfony\Component\Form\Extension\Core\Type\PasswordType',
            ])
            ->add('profileImage', FileType::class)
            ->add('competences', CompetencesTypeAdd::class)
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
