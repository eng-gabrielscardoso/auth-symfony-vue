<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
final class HealthController extends AbstractController
{
    #[Route('/', name: 'health')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'API is working',
        ]);
    }
}
