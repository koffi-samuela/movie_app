<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/movies', name: 'app_movie')]
// #[IsGranted('ROLE_ADMIN')]
class MovieController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(MovieRepository $movieRepository): Response
    {
        $currentUser = $this->getUser(); // Pour vérifier que l'utilisateur est connecté sinon redirection
        // $this->denyAccessUnlessGranted('ROLE');
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // dd($movieRepository ->findByActor(28));
        // $category = $categoryRepository->find(9);
        return $this->render('movie/index.html.twig', [
            // 'movies' => $movieRepository ->findBy(['categories.id'=>6]) 
            'movies' => $movieRepository ->findByActor(34),
        ]);
    }
    #[Route('/delete/{id}', name: '_delete')]
    public function delete( Movie $movie,Request $request,EntityManagerInterface $em): Response
    {
        $em->remove( $movie );
        $em->flush();
        return $this->redirectToRoute('_movie');
    }
    #[Route('/create', name: '_create')]
    public function create(Request $request,EntityManagerInterface $em): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // ... persist the $product object here.
            $em->persist($movie);
            $em->flush();
            return $this->redirectToRoute('_movie');
            
       }
        return $this->render('movie/create.html.twig', [
            'formcreate' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: '_show')]
    public function show(Movie $movie): Response
    {

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }
    #[Route('/edit/{id}', name: '_edit')]
    public function edit(int $id, Movie $movie,Request $request,EntityManagerInterface $em): Response
    {
        // $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            // $movie->setUpdatedAt(new \DateTime);
            
            // ... persist the $product object here.
            $em->persist($movie);
            $em->flush();
            return $this->redirectToRoute('app_movie');
            
       }

        return $this->render('movie/edit.html.twig', [
            'edit_form' => $form,
        ]);
    }

}
