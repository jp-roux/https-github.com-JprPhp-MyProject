<?php
// src/Jeanphilippe/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace Jeanphilippe\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use jeanphilippe\BlogBundle\Entity\Categorie;

class LoadCategorieData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userCategorie = new Categorie();
        $userCategorie->setNom('Categorie 1');
 
        $manager->persist($userCategorie);
        $manager->flush();
    }

 

}
