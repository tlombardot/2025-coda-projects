<?php

namespace App\Repository;

use App\Entity\Expense;
use App\Entity\Wallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Expense>
 */
class ExpenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expense::class);
    }

    /**
     * Récupère les dépenses d'un portefeuille avec pagination.
     *
     * @param Wallet $wallet Le portefeuille concerné
     * @param int $page Le numéro de la page actuelle
     * @param int $limit Le nombre de résultats par page
     * @return Expense[]
     */
    public function findExpensesForWallet(Wallet $wallet, int $page, int $limit): array
    {
        $offset = ($page - 1) * $limit;

        return $this->createQueryBuilder('e')
            ->andWhere('e.wallet = :wallet')
            ->setParameter('wallet', $wallet)
            ->orderBy('e.createdDate', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function countExpensesForWallet(Wallet $wallet): int
    {
        return $this->createQueryBuilder('e')
            ->select('count(e.id)') // On compte les ID
            ->andWhere('e.wallet = :wallet')
            ->setParameter('wallet', $wallet)
            ->getQuery()
            ->getSingleScalarResult(); // Retourne directement un entier
    }
}
