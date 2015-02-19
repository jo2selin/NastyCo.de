<?php
// Fichier Joli/Bundle/BlogBundle/Form/ProposePostType.php
namespace Joli\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProposePostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title')
			->add('body')
		;
	}
		public function getName()
	{
		return 'propose_post_type';
	}
}