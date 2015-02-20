<?php
// Fichier Nastycode/Bundle/FrontBundle/Form/SignInPostType.php

namespace Nastycode\Bundle\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SignInPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('email', 'email');
        $builder->add('country', 'country');
        $builder->add('password', 'password');
    }

    public function getName()
    {
        return 'signinpostype';
    }
}