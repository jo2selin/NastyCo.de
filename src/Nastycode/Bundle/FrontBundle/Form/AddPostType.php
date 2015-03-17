<?php

namespace Nastycode\Bundle\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class AddPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('codenasty', 'textarea')
            ->add('codeclean', 'textarea')
            ->add('lang', 'choice', array(
                'choices' => array('html' => 'HTML', 'css' => 'CSS', 'scss' => 'SASS', 'php' => 'PHP', 'javascript' => 'JS', 'ruby' => 'RUBY', 'python' => 'PYTHON')))
            ->add('envoyer', 'submit')
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

    }

    public function getName()
    {
        return 'Nastycode_frontbundle_addposttype';
    }
}