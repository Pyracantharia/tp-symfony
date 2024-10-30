<?php

declare(strict_types=1);

namespace App\Controller\Other;

use App\Repository\PlaylistRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ListController extends AbstractController
{
    #[Route(path: '/lists', name: 'my_lists')]
    public function show(PlaylistRepository $playlistRepository): Response
    {
        $playlists = $playlistRepository->findAll();

        return $this->render(
            'other/lists.html.twig',
            [
                'playlists' => $playlists,
            ]
        );
    }
}
