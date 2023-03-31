<?php

namespace App\Repository;

use App\Entity\Party;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Party>
 *
 * @method Party|null find($id, $lockMode = null, $lockVersion = null)
 * @method Party|null findOneBy(array $criteria, array $orderBy = null)
 * @method Party[]    findAll()
 * @method Party[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Party::class);
    }

    public function save(Party $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Party $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findParty($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM party p
            WHERE p.id = '.$id.';
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findAllAvailableParty($party_optional_request): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM party p
            WHERE p.last_sign_in > NOW() AND 
            p.player_number_needed > 0 AND
            p.canceled = 0 '. $party_optional_request . ';
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findLastAvailableParty(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM party p
            WHERE p.last_sign_in > NOW() AND 
            p.player_number_needed > 0 AND
            p.canceled = 0
            ORDER BY
            created_at DESC
            LIMIT 5;
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function checkIfPartyIsAvailable($partyID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT COUNT(id) FROM party p
            WHERE id = '. $partyID .' AND
            p.last_sign_in > NOW() AND 
            p.player_number_needed > 0 AND
            p.canceled = 0 AND;
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    } 

    public function findNumberOfHostedParty($userID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT COUNT(id) FROM party p
            WHERE user_host_id = '. $userID .' AND
            p.canceled = 0;
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    } 
    
    public function findHostPlayer($partyID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT U.* FROM party P
            INNER JOIN user U
            ON P.user_host_id = U.id
            WHERE P.id = '. $partyID .'            
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    //    /**
    //     * @return Party[] Returns an array of Party objects
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

    //    public function findOneBySomeField($value): ?Party
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
