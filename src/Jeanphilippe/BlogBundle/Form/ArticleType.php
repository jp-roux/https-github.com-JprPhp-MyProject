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
            ->add('auteur', null, array( 'attr'=> array( 'title' =>  "L'auteur doit être entre 3C et 10C ")))
            ->add('datecreation', 'datetime')
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
