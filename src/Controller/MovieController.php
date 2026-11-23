<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MovieController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalog', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAllWithCategory();

        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route(
        '/catalogue/{id}',
        name: 'app_movie_show',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function show(Movie $movie): Response
    {
        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route(
        '/api/catalogue',
        name: 'api_movie_list',
        methods: ['GET'],
        format: 'json'
    )]
    public function list(): JsonResponse
    {
        return $this->json([
            ['id' => 1, 'title' => 'Inception'],
            ['id' => 2, 'title' => 'Interstellar'],
            ['id' => 3, 'title' => 'Le Voyage de Chihiro'],
        ]);
    }
}