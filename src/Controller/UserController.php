<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class UserController extends AbstractController
{

    #[Route('/user', name: 'all_users')]
    public function index(UserRepository $repo): Response
    {
        $users = $repo->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }
    #[Route('/login', name: 'login')]
    public function login(): Response
    {

        return $this->render('user/_form.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {

    }
}


