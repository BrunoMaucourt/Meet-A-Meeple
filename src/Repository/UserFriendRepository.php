<?php

namespace App\Repository;

use App\Entity\UserFriend;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserFriend>
 *
 * @method UserFriend|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFriend|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFriend[]    findAll()
 * @method UserFriend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFriendRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFriend::class);
    }

    public function save(UserFriend $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserFriend $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findFriend($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM user_friend
        INNER JOIN user
        ON user.id = user_friend.user_friend_id
        WHERE user_friend.user_id ='. $user_ID .';
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findFriendNumber($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT count(*) FROM `user_friend`
        WHERE user_id ='. $user_ID .';
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function checkIfAlreadyFriend($user_ID, $target_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM `user_friend`
        WHERE user_id ='. $user_ID .' AND
        user_friend_id ='. $target_ID .';
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return UserFriend[] Returns an array of UserFriend objects
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

//    public function findOneBySomeField($value): ?UserFriend
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
