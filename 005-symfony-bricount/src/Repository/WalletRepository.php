<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Wallet;
use App\Entity\XUserWallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wallet>
 */
class WalletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wallet::class);
    }

    /**
     * Récupère tous les Wallets liés à un User via l'entité XUserWallet.
     *
     * @param User $user L'utilisateur cible.
     * @return Wallet[]
     */
    public function getWalletsForUser(User $user): array
    {
        return $this->createQueryBuilder('w')
            ->join(XUserWallet::class, 'xuw', 'WITH', 'xuw.wallet = w.id')
            ->andWhere('xuw.targetUser = :user')
            ->setParameter('user', $user)
            ->orderBy('w.label', 'ASC')
            ->getQuery()
            ->getResult();
    }
    
}
