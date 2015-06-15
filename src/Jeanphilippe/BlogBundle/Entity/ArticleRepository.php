<?php

namespace Jeanphilippe\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

	public function getArticles()
	{
		$qb = $this->createQueryBuilder('a')		// article est un alias sur la table objet

					->LeftJoin('a.image', 'i')			// Fait la jointure sur la tabe image			
					->addSelect('i')
					->LeftJoin('a.categories', 'c')
					->addSelect('c')
					
					->where('a.publication = :val')
					->setParameter('val', 1)
					->orderBy('a.datecreation', 'DESC');
					
		$query = $qb->getQuery();
		return $query->getResult();
		
	}
	
	public function getArticle( $id)
	{
		$qb = $this->createQueryBuilder('a')		

					->LeftJoin('a.image', 'i')					
					->addSelect('i')

					->LeftJoin('a.categories', 'cat')
					->addSelect('cat')

					->LeftJoin('a.commentaires', 'com')
					->addSelect('com')
								
					->where('a.id = :val2')
					->setParameter('val2', $id)
					
					->orderBy('a.datecreation', 'DESC');
					
		$query = $qb->getQuery();
		return $query->getOneOrNullResult();
		
	}
	
}