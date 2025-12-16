<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Wallet;
use App\Repository\WalletRepository;

class WalletService
{
    private WalletRepository $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * Retourne la liste des portefeuilles (Wallets) pour un utilisateur donné.
     *
     * @param User $user L'utilisateur pour lequel récupérer les portefeuilles.
     * @return Wallet[] Un tableau d'objets Wallet.
     */
    public function findWalletsForUser(User $user): array
    {
        return $this->walletRepository->getWalletsForUser($user);
    }
}
