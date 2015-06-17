<?php
// src/Jeanphilippe/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace Jeanphilippe\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use jeanphilippe\BlogBundle\Entity\Categorie;
use jeanphilippe\BlogBundle\Entity\Article;

class LoadUserData implements FixtureInterface
{
 
   /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
		for( $i = 0 ; $i < 100  ; $i++){
	        $userArticle = new Article();
    	    $userArticle->setTitre('Titre article ' .$i);
        	$userArticle->setContenu('Contenu article ' .$i);
	        $userArticle->setDatecreation( new \DateTime());
    	    $userArticle->setPublication( true);
        	$userArticle->setAuteur('Auteur article ' .$i);
	        $userArticle->setTitre('Titre article ' .$i);
 
    	    $manager->persist($userArticle);
        	$manager->flush();
		}
    }


}
