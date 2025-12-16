<?php

namespace App\Controller\Wallets;

use App\Entity\User;
use App\Service\WalletService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListController extends AbstractController
{
    #[Route('/wallets', name: 'wallets_list', methods: ['GET'])]
    public function index(WalletService $walletService): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();

        $wallets = $walletService->findWalletsForUser($user);
        return $this->render('wallets/list/index.html.twig', [
            'wallets' => $wallets,
        ]);
    }
}
