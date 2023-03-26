<?php

namespace App\Repository;

use App\Entity\PartyUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PartyUser>
 *
 * @method PartyUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartyUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartyUser[]    findAll()
 * @method PartyUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartyUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartyUser::class);
    }

    public function save(PartyUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PartyUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function checkIfAlreadyRegister($partyID, $user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT COUNT(id) FROM party_user
            WHERE party_id = '. $partyID .' AND
            user_id = '.$user_ID.' ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findPartyID($partyID, $user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT id FROM party_user
            WHERE party_id = '. $partyID .' AND
            user_id = '.$user_ID.' ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    } 

    public function findPartyWithID($partyID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT user_id FROM party_user
            WHERE party_id = '. $partyID .'
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    } 

    public function findAllIncommingUserParty($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT p.id FROM party p 
            INNER JOIN party_user PU 
            WHERE p.id = PU.party_id AND 
            PU.user_id = '. $user_ID .' AND 
            p.canceled = 0 AND 
            p.date > NOW()
            ';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findAllFinishedUserParty($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT p.id FROM party p 
            INNER JOIN party_user PU 
            WHERE p.id = PU.party_id AND 
            PU.user_id = '. $user_ID .' AND 
            p.canceled = 0 AND 
            p.date < NOW()
            ';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();

    }

    public function findAllCreatedUserParty($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT p.id FROM party p 
            INNER JOIN party_user PU 
            WHERE p.id = PU.party_id AND 
            PU.user_id = '. $user_ID .' AND 
            p.canceled = 0 AND 
            p.user_host_id = '. $user_ID .'
            ';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();

    }

    public function findAllCanceledUserParty($user_ID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT p.id FROM party p 
            INNER JOIN party_user PU 
            WHERE p.id = PU.party_id AND 
            PU.user_id = '. $user_ID .' AND 
            p.canceled = 1 
            ';


        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return PartyUser[] Returns an array of PartyUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PartyUser
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
