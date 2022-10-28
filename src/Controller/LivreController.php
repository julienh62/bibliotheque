<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Autor;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class LivreController extends AbstractController
{
//

//
//    #[Route("/livre", name: 'all_livre')]
//    public function index(BookRepository $repo): Response
//    {
//        $books = $repo->findAll();
//
//        return $this->render('livre/index.html.twig', [
//            'books' => $books
//        ]);
//    }
//
//    #[Route("/livre/{id}", name: 'show_livre')]
//    public function showLivre(BookRepository $bookRepository, int $id): Response
//    {
//        $book = $bookRepository->find($id);
//
//        return $this->render('livre/showLivre.html.twig', [
//            'book'=> $book
//        ]);
//    }

    #[Route("/livre", name: 'all_livre', methods: ['GET'])]
    public function index(BookRepository $repo, Request $request): Response
    //ici ajout requete qui permet de recuperer tts les donnees et ici pour parmetre affichage
        //avec display short ou complete version
    {

        return $this->render('livre/index.html.twig', [
            'books' => $repo->findAll(),
            'mode' => $request->query->get('display')
            // $request->query va permettre accder aux donneés de la requete
        ]);
    }

    #[Route("/livre/{id}", name: 'show_livre', methods: ['GET'])]
    #[Template('livre/showLivre.html.twig')]
    public function show(Book $book)
    {
        return [
            'book' => $book
        ];
    }

    #[Route("/livre/{id}/autor", name: "show_livre_by_autor", methods: ['GET'])]
    #[Template('livre/list_by_autor.html.twig')]
    public function showLivreByAutor(Autor $autor, BookRepository $repo): array
    {
        //$book = $repo->findBy(['autor' => $autor], [], 5)

        return [
            'books' => $autor->getDocumentsAutor()
        ];
    }

}

