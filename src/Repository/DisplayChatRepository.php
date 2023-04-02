<?php

namespace App\Repository;

use App\Entity\DisplayChat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DisplayChat>
 *
 * @method DisplayChat|null find($id, $lockMode = null, $lockVersion = null)
 * @method DisplayChat|null findOneBy(array $criteria, array $orderBy = null)
 * @method DisplayChat[]    findAll()
 * @method DisplayChat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisplayChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DisplayChat::class);
    }

    public function save(DisplayChat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DisplayChat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllUserIAmTalkingWith($user_ID){
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT U.id contact_id, U.first_name contact_first_name, U.picture_profil contact_profil_picture FROM display_chat DC
        INNER JOIN user U ON
        U.id = DC.user_recipient_id
        WHERE DC.user_sender_id = '.$user_ID.'';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function checkIfUserIsInChatList($user_ID,$target_ID){
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT count(*) count FROM display_chat DC
        WHERE DC.user_sender_id = '.$user_ID.' AND
        DC.user_recipient_id = '.$target_ID.'';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    //public function addUserToChatList($user_ID,$target_ID);//a faire sylfony

    public function removeUserToChatList($user_ID,$target_ID){
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        DELETE FROM display_chat
        WHERE user_sender_id = '.$user_ID.' 
        AND user_recipient_id = '.$target_ID.'';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative(); 
    }



//    /**
//     * @return DisplayChat[] Returns an array of DisplayChat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DisplayChat
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
