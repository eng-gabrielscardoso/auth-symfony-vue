<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class HealthController extends AbstractController
{
    #[Route('/', name: 'app_health')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'API is working',
        ]);
    }
}
