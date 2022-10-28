<?php

namespace App\Controller;

use App\Repository\AutorRepository;
use App\Entity\Autor;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediatekController extends AbstractController
{
    #[Route('/', name: 'index_site')]
    public function index(): Response
    {
        return $this->render('mediatek/index.html.twig');
    }




}


