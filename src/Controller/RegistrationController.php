<?php
// src/Controller/RegistrationController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Karriere\JsonDecoder\JsonDecoder;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;
use stdClass;

class RegistrationController extends AbstractController
{
    private JsonDecoder $jsonDecoder;

    public function __construct()
    {
        $this->jsonDecoder = new JsonDecoder();
    }

    #[Route('/register', methods: ['POST'])]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, 
                            UserRepository $userRepository, ValidatorInterface $validator)
    {
        try {
            $content = $request->getContent();
            //$user = $this->jsonDecoder->decode($content, User::class,'user');
            $decoded = json_decode($content,true);
            $user = $this->jsonDecoder->decodeArray($decoded['user'], User::class);
            $s_admin_secret = $this->getParameter('super_admin_secret');
            if (isset($decoded['superAdminPassword']) && $decoded['superAdminPassword'] == $s_admin_secret) {
                $user->setRoles(['ROLE_ADMIN']);
            }
            $errors = $validator->validate($user);
            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                throw new BadCredentialsException($errorsString);
            }
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);
            $user = $userRepository->saveUser($user);
            $payload = [
                "id" => $user->getId(),
                "email" => $user->getUserIdentifier(),
                "roles" => $user->getRoles(),
                "expire"  => (new \DateTime())->modify("+5 minutes")->getTimestamp(),
            ];
            $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');
            return $this->json([
                'user'  => $user->getUserIdentifier(),
                'token' => $jwt,
            ]);
            return $this->json([
                'user'  => ""
            ]);
        } catch (\Exception $exception) {
            return New Response($exception->getMessage(),500);
        }
    }
}
