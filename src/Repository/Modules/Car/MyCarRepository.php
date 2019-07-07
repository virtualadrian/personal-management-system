<?php

namespace App\Repository\Modules\Car;

use App\Entity\Modules\Car\MyCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MyCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyCar[]    findAll()
 * @method MyCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyCarRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, MyCar::class);
    }

    public function getIncomingCarSchedulesInMonths(int $months){

        $connection = $this->getEntityManager()->getConnection();

        $sql = "
            SELECT name AS name,
              date      AS date,
              DATEDIFF(STR_TO_DATE(date, '%m-%d-%Y'),NOW()) AS daysDiff
            FROM my_car
            WHERE STR_TO_DATE(date, '%m-%d-%Y') BETWEEN NOW() AND NOW() + INTERVAL $months MONTH
            AND DATEDIFF(STR_TO_DATE(date, '%m-%d-%Y'),NOW()) > 0
        ";

        $statement = $connection->executeQuery($sql);
        $results   = $statement->fetchAll();

        return $results;
    }

}
