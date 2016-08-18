<?php

namespace AdminBundle\Form\Type;

use AdminBundle\Manager\AdminManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditProfileType extends AbstractType
{
    protected $adminManger;

    public function __construct(AdminManagerInterface $manager)
    {
        $this->adminManger = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text')
            ->add('lastname', 'text')
            ->add('phone', 'text',  [
                'required' => false
            ])
            ->add('comment', 'textarea', [
                'required' => false
            ])
            ->add('save', 'submit');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->adminManger->getUserClass(),
            'validation_groups' => function () {
                return ['Admin'];
            }
        ]);
    }

    public function getName()
    {
        return 'admin_edit_profile';
    }
}