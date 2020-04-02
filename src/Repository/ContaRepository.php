<?php
namespace MimMarcelo\ContaContas\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 */
class ContaRepository extends EntityRepository
{
    /**
     *
     * @return type array
     */
    public function getContasPorPeriodo($dInicial, $dFinal): array
    {
        $query = $this->createQueryBuilder("c")
                ->where("c.dataAplicacao >= :inicio")
                ->andWhere("c.dataAplicacao <= :fim")
                ->setParameter('inicio', $dInicial)
                ->setParameter('fim', $dFinal)
                ->getQuery();

        return $query->getResult();
    }
}

 ?>
