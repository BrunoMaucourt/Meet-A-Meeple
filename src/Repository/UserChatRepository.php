<?php

namespace App\Repository;

use App\Entity\UserChat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserChat>
 *
 * @method UserChat|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserChat|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserChat[]    findAll()
 * @method UserChat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserChat::class);
    }

    public function save(UserChat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserChat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllUserTalkingWith($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT U.id contact_id, U.first_name contact_first_name, U.picture_profil contact_profil_picture FROM user_chat UC
        INNER JOIN user U ON
        U.id = UC.user_recipient_id
        WHERE UC.user_sender_id = '.$user_ID.'';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findAllUserTalkingToMe($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT U.id contact_id, U.first_name contact_first_name, U.picture_profil contact_profil_picture FROM user_chat UC
        INNER JOIN user U ON
        U.id = UC.user_sender_id
        WHERE UC.user_recipient_id = '.$user_ID.'';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findAllMessageFromDiscussion($user_ID,$other_user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM user_chat UC
        WHERE (user_sender_id ='.$user_ID.' AND user_recipient_id = '.$other_user_ID.')
        OR
        (user_sender_id = '.$other_user_ID.' AND user_recipient_id = '.$user_ID.')
        ORDER BY UC.created_at ASC;';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function SetAllMessageFromDiscussionToRead($user_ID,$other_user_ID)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        UPDATE user_chat UC SET UC.message_read = 1 
        WHERE UC.user_sender_id = '.$other_user_ID.' AND UC.user_recipient_id = '.$user_ID.';';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
    }

    

    public function findNonReadMessageCount($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT COUNT(*)count FROM user_chat UC
        WHERE UC.user_recipient_id = '.$user_ID.' AND
        UC.message_read = 0';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();

    }

    


//    /**
//     * @return UserChat[] Returns an array of UserChat objects
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

//    public function findOneBySomeField($value): ?UserChat
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
