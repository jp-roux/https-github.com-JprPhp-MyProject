<?php

namespace Jeanphilippe\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jeanphilippe\BlogBundle\Entity\Article;
use Jeanphilippe\BlogBundle\Form\ArticleType;
use Jeanphilippe\BlogBundle\Entity\Image; 
use Jeanphilippe\BlogBundle\Entity\Commentaire; 
use Jeanphilippe\BlogBundle\Entity\Categorie; 

class BlogController extends Controller
{
    public function indexAction()
    {
		$repository = $this->getDoctrine()->getManager()->getRepository( 'JeanphilippeBlogBundle:Article');
		//$articles   = $repository->findAll();
		$articles   = $repository->getArticles();
		
        return $this->render('JeanphilippeBlogBundle:Blog:index.html.twig', array('articles' => $articles));
    }
	
    public function voirAction($id)
    {
		/* Methode 1
		$repositoryA 	= $this->getDoctrine()->getManager()->getRepository( 'JeanphilippeBlogBundle:Article');
		//$repositoryCom 	= $this->getDoctrine()->getManager()->getRepository( 'JeanphilippeBlogBundle:Commentaire');
		$repositoryCat 	= $this->getDoctrine()->getManager()->getRepository( 'JeanphilippeBlogBundle:Categorie');
		$article   		= $repositoryA->find($id);
		//$commentaires   = $repositoryCom->findBy( array('article'=>$article), array('date' => 'desc'));
		$commentaires	= $article->getCommentaires();
		$categories  	= $article->getCategories();
		*/
		
		/* Methode 2*/
		$repository 	= $this->getDoctrine()->getManager()->getRepository( 'JeanphilippeBlogBundle:Article');
		$article   		= $repository->getArticle( $id);
	
        //return $this->render('JeanphilippeBlogBundle:Blog:voir.html.twig', array('article' => $article, 'commentaires' => $commentaires, 'categories' => $categories));
        //return $this->render('JeanphilippeBlogBundle:Blog:voir.html.twig', array('article' => $article, 'categories' => $categories));
        //return $this->render('JeanphilippeBlogBundle:Blog:voir.html.twig', array('article' => $article, 'categories' => $categories));
        return $this->render('JeanphilippeBlogBundle:Blog:voir.html.twig', array('article' => $article));
    }
	
    public function ajouterAction()
    {
	/** Methode 1
		$em = $this->getDoctrine()->getManager();

		$article1 = new Article();
		$article1->setTitre('Hello world');
		$article1->setAuteur('jpr');
		$article1->setContenu('ContenuArticle');
		
		$image = new Image();
		$image->setUrl('photo.jpg');
		$image->setAlt('Image article');
		
		$article1->setImage( $image);
		

		// Ajout de 2 commentaire2
		$commentaire1 = new Commentaire();
		$commentaire1->setAuteur( 'JPR');
		$commentaire1->setContenu( 'Commentaire 1');
		$commentaire1->setArticle( $article1);

		$commentaire2 = new Commentaire();
		$commentaire2->setAuteur( 'JPR');
		$commentaire2->setcontenu( 'Commentaire 2');
		$commentaire2->setArticle( $article1);

		// Ajout de 2 categories
		$categorie1 = new Categorie();
		$categorie1->setNom('Categorie 1');
		$article1->addCategory( $categorie1);

		$categorie2 = new Categorie();
		$categorie2->setNom('Categorie 2');
		$article1->addCategory( $categorie2);


		$em->persist( $article1);     
		$em->persist( $commentaire1);     
		$em->persist( $commentaire2);     
		$em->persist( $categorie1);     
		$em->persist( $categorie2);     
	
		
		$em->flush( );				// On demarre latransaction pour les objets mis en persistence  
									// et fait commit/rollback   
        return $this->render('JeanphilippeBlogBundle:Blog:ajouter.html.twig', array('article' => $article1));
**/
			$article = new Article();
/**
			$formBuilder = $this->createFormBuilder( $article);
			
			// On ajoute les champs que l'on veut afficher
			$formBuilder->add( 'datecreation', 'date')
						->add( 'titre', 'text')
						->add( 'contenu', 'textarea')
						->add( 'auteur', 'text')
						->add( 'publication', 'checkbox');   // Type html
						
			// A partir du formBuilder on gènère le formulaire
			$form = $formBuilder->getForm();
**/
			$form = $this->createForm( new ArticleType, $article);
			
			$request = $this->getRequest();
			if( $request->getMethod() == "POST"){
				$form->handleRequest( $request);
				if( $form->isValid()){
					
					try{
						$entityManager = $this->getDoctrine()->getManager();
						$entityManager->persist( $article);
						$entityManager->flush();
					}catch( Exception $ex){
					}
				
				}
			}
			
			// On passe la methode createView du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
			return $this->render( 'JeanphilippeBlogBundle:Blog:ajouter.html.twig', array('form' => $form->createView() ));
			
    }	
    public function modifierAction($id)
    {
		$em 		= $this->getDoctrine()->getManager();
		$repository = $this->getDoctrine()->getManager()->getRepository( 'JeanphilippeBlogBundle:Article');
		$article    = $repository->find($id);
		$article->setTitre( 'Nouveau titre ***');
		
		//$em->persist( $article); 	
		$em->flush( );			
	
        //return $this->redirect( $this->generateUrl('jeanphilippe_voir', array('article' => $article)));
        return $this->render('JeanphilippeBlogBundle:Blog:modifier.html.twig', array('article' => $article));
		
		
    }	
    public function menuGaucheAction()
    {
		$repository = $this->getDoctrine()->getManager()->getRepository( 'JeanphilippeBlogBundle:Article');
		$articles   = $repository->findBy( array(), array('datecreation' => 'desc'),  3, 0);
		
        return $this->render('JeanphilippeBlogBundle:Blog:menuGauche.html.twig', array('articles' => $articles));
    }	
}
