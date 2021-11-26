<?php
// src/Controller/RegistrationController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\ExceptionInterface;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Karriere\JsonDecoder\JsonDecoder;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;

class RegistrationController extends AbstractController
{
    private JsonDecoder $jsonDecoder;

    public function __construct()
    {
        $this->jsonDecoder = new JsonDecoder();
    }

    #[Route('/api/register', methods: ['POST'])]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, 
                            UserRepository $userRepository, ValidatorInterface $validator)
    {
        try {
            $user = $this->jsonDecoder->decode($request->getContent(), User::class);
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
            return $this->json([
                'user'  => $user->getUserIdentifier(),
                'token' => "",
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'exception'  => $exception->getMessage(),
                'token' => "",
                'code'  => $exception->getCode()
            ]);
        }
    }
}
