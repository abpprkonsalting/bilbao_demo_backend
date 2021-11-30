<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\RedirectResponse;

class WebTestController extends AbstractController
{
    #[Route('/web', name: 'web_test')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/WebTestController.php',
        ]);
    }

    #[Route('/', name: 'homepage')]
    public function homepage(): RedirectResponse
    {
        return new RedirectResponse('/web');
        // return $this->json([
        //     'exception'  => "",
        //     'token' => "",
        //     'code'  => ""
        // ]);
    }
}
