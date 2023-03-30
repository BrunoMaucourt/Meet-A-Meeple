<?php

namespace App\Repository;

use App\Entity\UserBlackList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserBlackList>
 *
 * @method UserBlackList|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBlackList|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBlackList[]    findAll()
 * @method UserBlackList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBlackListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBlackList::class);
    }

    public function save(UserBlackList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserBlackList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBlackList($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM `user_black_list`
        INNER JOIN user 
        ON user.id = user_black_list.user_banned_id
        WHERE user_that_block_id ='. $user_ID .';
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function checkIfAlreadyBlackList($user_ID, $target_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM `user_black_list`
        WHERE user_that_block_id ='. $user_ID .' AND
        user_banned_id ='. $target_ID .';
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return UserBlackList[] Returns an array of UserBlackList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserBlackList
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
