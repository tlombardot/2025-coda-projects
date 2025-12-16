<?php

namespace App\Controller\Wallets;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateController extends AbstractController
{
    #[Route('/wallets/create', name: 'wallets_create', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('wallets/create/index.html.twig', [
        ]);
    }
}
