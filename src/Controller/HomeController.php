<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\MovieRepository;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    public function index(MovieRepository $movieRepository): Response
    {
        // Récupère les films à afficher
        $movies = $movieRepository->findAll();

        // Envoie les films au template index.html.twig
        return $this->render('index.html.twig', [
            'movies' => $movies
        ]);
    }
}
