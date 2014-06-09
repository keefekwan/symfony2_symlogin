<?php
// src/JFCModelBundle/Form/RegisterFormType.php

namespace JFC\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RegisterFormType
 */
class RegisterFormType extends AbstractType
{
    /**
     * {inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                )
            );
    }

    /**
     * {inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JFC\ModelBundle\Entity\User',
        ));
    }

    /**
     * {inheritDoc}
     */
    public function getName()
    {
        return 'user_register';
    }
}