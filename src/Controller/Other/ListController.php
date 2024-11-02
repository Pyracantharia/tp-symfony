<?php

declare(strict_types=1);

namespace App\Controller\Other;

use App\Repository\PlaylistRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


class ListController extends AbstractController
{
    #[Route(path: '/lists', name: 'my_lists')]
    public function show(PlaylistRepository $playlistRepository): Response
    {
        $user = $this->getUser();

        dd($user);

        $playlists = $playlistRepository->findByUser($user);

        return $this->render(
            'other/lists.html.twig',
            [
                'playlists' => $playlists,
            ]
        );
    }

    #[Route('/playlist/{id}/media/render', name: 'playlist_media_render')]
    public function renderMediaByPlaylist(int $id, PlaylistRepository $playlistRepository): JsonResponse
    {
        $playlist = $playlistRepository->find($id);

        if (!$playlist) {
            return new JsonResponse(['error' => 'Playlist not found'], Response::HTTP_NOT_FOUND);
        }

        $html = '';
        foreach ($playlist->getPlaylistMedia() as $playlistMedia) {
            $media = $playlistMedia->getMedia();
            $html .= $this->renderView('parts/movie_card_big.html.twig', [
                'media' => $media,
            ]);
        }

        return new JsonResponse(['html' => $html]);
    }



    #[Route('/playlist/{id}/media', name: 'playlist_media')]
    public function getMediaByPlaylist(int $id, PlaylistRepository $playlistRepository): JsonResponse
    {
        $playlist = $playlistRepository->find($id);

        if (!$playlist) {
            return new JsonResponse(['error' => 'Playlist not found'], Response::HTTP_NOT_FOUND);
        }

        $mediaData = [];
        foreach ($playlist->getPlaylistMedia() as $playlistMedia) {
            $media = $playlistMedia->getMedia();
            $mediaData[] = [
                'title' => $media->getTitle(),
                'releaseDate' => $media->getReleaseDate()?->format('Y'),
                'coverImage' => $media->getCoverImage(),
                // Ajouter d'autres champs si nécessaire
            ];
        }

        return new JsonResponse(['media' => $mediaData]);
    }


}
