<?php

namespace App\Service;

use App\Entity\Wallet;
use App\Repository\ExpenseRepository;

class ExpenseService
{
    private ExpenseRepository $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function findExpenseForWallet(Wallet $wallet, int $page, int $limit): array
    {
        return $this->expenseRepository->findExpensesForWallet($wallet, $page, $limit);
    }

    public function countExpensesForWallet(Wallet $wallet): int
    {
        return $this->expenseRepository->countExpensesForWallet($wallet);
    }
}
