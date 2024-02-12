<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'app_movie')]
    public function index(MovieRepository $movieRepository): Response
    {

        return $this->render('movie/index.html.twig', [
            'movies' => $movieRepository ->findAll(),
        ]);
    }
    #[Route('/{id}', name: 'app_show')]
    public function show(int $id,Movie $movie): Response
    {

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }
}
