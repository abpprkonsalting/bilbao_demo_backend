<?php
// src/Controller/RegistrationController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\ExceptionInterface;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;

class RegistrationController extends AbstractController
{
    #[Route('/api/register', methods: ['POST'])]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!isset($data["username"])) {
                throw new InvalidArgumentException("no username field in the request");
            }
            $user = new User($data["username"]);
            if (!isset($data["password"])) {
                throw new InvalidArgumentException("no password field in the request");
            }
            $plaintextPassword = $data["password"];

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user = $userRepository->saveUser($user);
            if ($user == null) {
                throw new UnsupportedUserException(sprintf('general error saving user "%s" in database.', $data["username"]));
            }
            return $this->json([
                'user'  => $user->getUserIdentifier(),
                'token' => "",
            ]);

        } catch (ExceptionInterface $exception) {
            return $this->json([
                'exception'  => $exception->getMessage(),
                'token' => "",
                'code'  => $exception->getCode()
            ]);
        }
    }
}
