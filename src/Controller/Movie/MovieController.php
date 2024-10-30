<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\MovieRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class MovieController extends AbstractController
{
    #[Route('/movie/{id}', name: 'show_movie', requirements: ['id' => '\d+'])]
    public function movie(int $id, MovieRepository $movieRepository): Response
    {
        // Récupère le film par son id
        $movie = $movieRepository->find($id);

        $categories = $movie->getCategories();

        // Gère le cas où le film n'existe pas
        if (!$movie) {
            throw $this->createNotFoundException('Le film n\'existe pas');
        }


        $categoriesName = "";
        foreach ($categories as $category) {
            $categoriesName = $category->getName();
        }


        // dd($categoriesName);
        
        // dd($categories);

        // Passe les informations du film au template
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie,
            'categoriesName' => $categoriesName
        ]);
    }
   
    #[Route('/serie', name: 'show_serie')]
    public function series(): Response
    {
        return $this->render('movie/detail_serie.html.twig');
    }
}
