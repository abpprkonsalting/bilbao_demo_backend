<?php 
// src/Controller/RegistrationController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Entity\User;
use App\Repository\UserRepository;

class RegistrationController extends AbstractController
{
    #[Route('/api/register')]
    public function index(UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository)
    {

        $user = new User("armbp1975@gmail.com");
        $plaintextPassword = "abcd1234*";

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $userRepository->saveUser($user);
    }
}