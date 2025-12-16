<?php

namespace App\Controller\Wallets;

use App\Entity\Wallet;
use App\Service\ExpenseService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class ShowController extends AbstractController
{
    #[Route(path: '/wallets/{uid}', name: 'wallets_show', requirements: ['uid' => Requirement::UUID], methods: ['GET'])]
    public function index(
        #[MapEntity(mapping: ['uid' => 'uuid'])]
        Wallet                   $wallet,
        ExpenseService           $expenseService,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] int $limit = 25
    )
    {
        $totalExpenses = $expenseService->countExpensesForWallet($wallet);
        $totalPages = max(1, (int)ceil($totalExpenses / $limit));

        if ($page > $totalPages) {
            return $this->redirectToRoute('wallets_show', [
                'uuid' => $wallet->getUuid(),
                'page' => $totalPages,
                'limit' => $limit
            ]);
        }
        $expenses = $expenseService->findExpenseForWallet($wallet, $page, $limit);

        return $this->render('wallets/show/index.html.twig', [
            'wallet' => $wallet,
            'expenses' => $expenses,
            'currentPage' => $page,
            'limit' => $limit,
            'totalPages' => $totalPages,
        ]);
    }
}
