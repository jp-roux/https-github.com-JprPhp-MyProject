<?php

namespace Jeanphilippe\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('publication')
            ->add('publication', 'checkbox', array("required"=>false))
            ->add('titre')
            ->add('contenu')
//            ->add('contenu', 'texarea', array('attr'=>array('class'=>'ckeditor')))
            ->add('auteur')
            ->add('datecreation')
//            ->add('image')
//            ->add('categories')
			->add('categories', 'entity',
					array("class" => "JeanphilippeBlogBundle:Categorie",
					"property" => "nom",
					"multiple" => true,
					"expanded" => true));
					
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jeanphilippe\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jeanphilippe_blogbundle_article';
    }
}
