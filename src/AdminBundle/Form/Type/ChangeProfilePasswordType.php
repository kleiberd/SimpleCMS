<?php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangeProfilePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', 'password')
            ->add('newPassword', 'repeated', [
                'type' => 'password',
                'required' => true
            ])
            ->add('changePassword', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AdminBundle\Form\Model\ChangeProfilePassword'
        ]);
    }

    public function getName()
    {
        return 'admin_change_profile_password';
    }
}