<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/auth', name: 'auth')]
final class AuthController extends AbstractController
{
    #[Route(path: '/me', name: 'me', methods: ['GET'])]
    public function me(SessionInterface $session): JsonResponse
    {
        $user = $session->get('user');

        if (!$user) {
            return new JsonResponse([
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse(data: $user);
    }

    #[Route(path: '/sign-in', name: 'sign-in', methods: ['POST'])]
    public function signIn(
        Request $request,
        UserRepository $userRespository,
        UserPasswordHasherInterface $passwordHasher,
        SessionInterface $session
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email'], $data['password'])) {
            return new JsonResponse([
                'message' => 'Missing required fields (email or password',
            ], Response::HTTP_BAD_REQUEST);
        }

        /**
         * @var \App\Entity\User
         */
        $user = $userRespository->findOneBy(criteria: ['email' => $data['email']]);

        if (!$user || !$passwordHasher->isPasswordValid(user: $user, plainPassword: $data['password'])) {
            return new JsonResponse([
                'message' => 'Invalid credetials'
            ], Response::HTTP_FORBIDDEN);
        }

        $payload = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];

        $session->set('user', $payload);

        return new JsonResponse([
            'data' => [
                'user' => $payload,
                'message' => 'Login successful',
            ]
        ]);
    }

    #[Route(path: '/sign-up', name: 'sign-up', methods: ['POST'])]
    public function signUp(Request $request, EntityManagerInterface $emi): JsonResponse
    {
        $data = json_decode(json: $request->getContent(), associative: true);

        if (!isset($data['name'], $data['email'], $data['password'])) {
            return new JsonResponse([
                'message' => 'Missing required fields'
            ], Response::HTTP_BAD_REQUEST);
        }

        /**
         * @var UserRepository|null
         */
        $userRepository = $emi->getRepository(User::class);

        if ($userRepository->findBy(criteria: ['email' => $data['email']])) {
            return new JsonResponse([
                'message' => 'User already exists',
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $userRepository->create($data['name'], $data['email'], $data['password']);

        return new JsonResponse([
            'message' => 'User created successfully'
        ], Response::HTTP_CREATED);
    }

    #[Route(path: '/sign-out', name: 'sign-out', methods: ['POST'])]
    public function signOut(SessionInterface $session): JsonResponse
    {
        $session->invalidate();

        return new JsonResponse([
            'message' => 'Logout successfully',
        ]);
    }
}
