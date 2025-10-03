<?php

namespace App\Controller\Api;

use App\Dto\LoginRequest;
use App\Dto\UserRequest;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\SerializerInterface;

final class SecurityController extends AbstractController
{

    public function __construct(
        private readonly  ObjectMapperInterface $mapper,
        private readonly  UserRepository $userRepository,
        private readonly  UserPasswordHasherInterface $passwordHasher,
        private readonly  SerializerInterface $serializer
    )
    {}

     #[Route('/login', name: 'app_login' , methods: ['POST'])]
     public function login(#[MapRequestPayload] LoginRequest $payload): Response
    {

        $user = $this->userRepository->findOneBy(['email' => $payload->email]);

        if (!$user || !$this->passwordHasher->isPasswordValid($user, $payload->password)) {
            return new JsonResponse(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

         $token = $this->userRepository->createToken($user);

        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'token' => $token,
          ]);
    }

    #[Route('/register', name: 'app_register' , methods: ['POST'])]
    public function register(#[MapRequestPayload] UserRequest $payload):Response
    {
      $user = $this->mapper->map($payload, User::class);
      $user->setPassword(
        $this->passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        )
      );
        $this->userRepository->save($user);
      $data = $this->serializer->serialize($user, 'json', ['groups' => 'user:read']);

        return JsonResponse::fromJsonString($data);
    }
}