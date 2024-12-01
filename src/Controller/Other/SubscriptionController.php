<?php
namespace App\Controller\Other;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{
    #[Route(path: '/subscriptions', name: 'subscriptions')]
    public function show(SubscriptionRepository $subscriptionRepository): Response
    {
        // Vérifiez si un utilisateur est connecté
        $user = $this->getUser();

        // Si un utilisateur est connecté, récupérez ses abonnements
        if ($user) {
            $subscriptions = $subscriptionRepository->findByUser($user);
        } else {
            // Si aucun utilisateur n'est connecté, vous pouvez afficher tous les abonnements ou rien
            $subscriptions = [];
        }

        return $this->render('other/abonnements.html.twig', [
            'subscriptions' => $subscriptions,
            'user' => $user,
        ]);
    }
}
