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

use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;

class RegistrationController extends AbstractController
{
    #[Route('/api/register', methods: ['POST'])]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository, ValidatorInterface $validator)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!isset($data["username"])) {
                throw new InvalidArgumentException("no username field in the request");
            }
            if (!isset($data["password"])) {
                throw new InvalidArgumentException("no password field in the request");
            }

            $user = new User($data["username"],$data["password"]);
            $errors = $validator->validate($user);

            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                throw new BadCredentialsException($errorsString);
            }

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $data["password"]
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
        } catch (\Exception $exception) {
            return $this->json([
                'exception'  => $exception->getMessage(),
                'token' => "",
                'code'  => $exception->getCode()
            ]);
        }
    }
}
