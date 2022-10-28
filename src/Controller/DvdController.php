<?php

namespace App\Controller;

use App\Repository\DvdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DvdController extends AbstractController
{
    #[Route('/dvd', name: 'all_dvd')]
    public function index(DvdRepository $repo): Response
    {
        $dvds = $repo->findAll();
        return $this->render('dvd/index.html.twig', [
          'dvds' => $dvds
        ]);
    }


    #[Route("/dvd/{id}", name: 'show_dvd')]
    public function showLivre(DvdRepository $dvdRepository, int $id): Response
    {
        $dvd = $dvdRepository->find($id);

        return $this->render('dvd/showDvd.html.twig', [
            'dvd'=> $dvd
        ]);
    }
}
