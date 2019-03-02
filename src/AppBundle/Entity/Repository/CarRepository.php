<?php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{
    public function getFrontendList($model, $engine_size)
    {
        $query = $this->createQueryBuilder('c');

        $query->where('c.isActive = 1');

        if(!empty($model)){
            $query->andWhere('c.model LIKE :model');
            $query->setParameter('model',  '%'.$model.'%');
        };

        if(!empty($engine_size)){
            $query->andWhere('c.engineSize=:engineSize');
            $query->setParameter('engineSize',  $engine_size);
        };

        $query->orderBy('c.price', 'ASC');

       return $query->getQuery()->getResult();
    }
}