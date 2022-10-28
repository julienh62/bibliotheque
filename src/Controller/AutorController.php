<?php

namespace App\Controller;

use App\Form\AutorType;
use App\Form\AutorUpdateType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AutorRepository;
use App\Entity\Autor;


class AutorController extends AbstractController
{
    #[Route('/autors', name: 'all_autors')]
    public function index(AutorRepository $repo): Response
    {
        $autors= $repo->findAll();
        return $this->render('autor/index.html.twig', [
           'autors' => $autors
        ]);
    }

    #[Route("/autor/{id}", name: 'show_autor')]
    public function showLivre(AutorRepository $autorRepository, int $id): Response
    {
        $autor = $autorRepository->find($id);

        return $this->render('autor/showAutor.html.twig', [
            'autor'=> $autor
        ]);
    }
// 1ere methode pour afficher
    #[Route("/autor", name: 'form_autor', methods:['GET'])]
    public function newAutor() {
       $autor = new Autor();

       $form = $this->createForm(AutorType::class, $autor);

           return $this->renderForm('autor/form.html.twig', [
           'form' => $form
            ]);
    }

//2eme methode pour enregistrer
    #[Route("/autor", name: 'form_autor_return', methods:['POST'])]
    public function savenewAutor(Request $request, EntityManagerInterface $manager) {
       $autor = new Autor();

       $form = $this->createForm(AutorType::class, $autor);
       $form->handleRequest($request);
       //handleRequest manipule la requte 


       if ($form->isSubmitted()&& $form->isValid()) {
           $manager->persist($autor);
           $manager->flush();
          return $this->redirectToRoute('all_autors');

      }

           return $this->renderForm('autor/form.html.twig', [
           'form' => $form
            ]);
    }


    //  methode pour afficher
    #[Route("/autor/{id}/edit", name: 'edit_autor', methods:['GET'])]
    public function updateAutor(Autor $autor)
    {
        $form = $this->createForm(AutorUpdateType::class, $autor);

        return $this->renderForm('autor/form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route("/autor/{id}/edit", name: 'saveupdate_autor', methods:['PATCH'])]
    public function saveUpdateAutor( Autor $autor, Request $request, EntityManagerInterface $manager)
    {

        $form = $this->createForm(AutorUpdateType::class, $autor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->flush();
          return $this->redirectToRoute('all_autors');

        }
        return $this->renderForm('autor/form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route("/autor/{id}/delete", name: 'delete_autor', methods:['GET'])]
    public function deleteAutor(Autor $autor , EntityManagerInterface $entityManager)
   {
     $entityManager->remove($autor);
     $entityManager->flush();

     return $this->redirectToRoute('all_autors');
   }

}
