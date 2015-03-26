<?php
namespace Mems\MemsBundle\Entity;
use Doctrine\ORM\EntityRepository;
class MemRandomRepository extends EntityRepository
{
    public function getRandom()
    {
        // pobieramy ilość memów
        $count = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.isAccepted = true')
            ->getQuery()
            ->getSingleScalarResult();
        //zwracamy losowego mema
        if (!$count) {
           
        } else {
        return $this->createQueryBuilder('u')
            ->where('u.isAccepted = true')
            ->setFirstResult(rand(0, $count - 1))
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    } }
 
     public function getMemAvgRating($mem)
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select('count(r.id) as totalRatingCount,
            avg(r.rating) as avgRating')
            ->from('MemsMemsBundle:Rating', 'r')
            ->where('r.mem = :mem')
            ->setParameter('mem', $mem);
        return $query->getQuery()->getSingleResult();
    }   
}