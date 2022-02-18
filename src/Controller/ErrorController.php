<?php
// src/Controller/ErrorController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Karriere\JsonDecoder\JsonDecoder;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Entity\User;
use App\Repository\UserRepository;

class ErrorController extends AbstractController
{
    public function index():RedirectResponse
    {
//        return new RedirectResponse('/web');
    }
}
