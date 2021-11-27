<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Firebase\JWT\JWT;

use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/login', name: 'api_login')]
    public function index(): Response
    {
        $user = $this->getUser() ? $this->getUser() : null;
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $payload = [
            "user" => $user->getUserIdentifier(),
            "expire"  => (new \DateTime())->modify("+5 minutes")->getTimestamp(),
        ];
        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');
        return $this->json([
            'message' => 'success!',
            'token' => $jwt,
        ]);
    }
}
