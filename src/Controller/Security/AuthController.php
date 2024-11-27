<?php

declare(strict_types=1);

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthController extends AbstractController
{
    #[Route(path: '/login', name: 'login')]
    public function login(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage'); // Redirige vers la page d'accueil
        }
    
        return $this->render('auth/login.html.twig');
    }

    #[Route(path: '/register', name: 'register')]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage'); // Redirige vers la page d'accueil si l'utilisateur est déjà connecté
        }
    
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Assigner un rôle par défaut à l'utilisateur
            $user->setRoles(['ROLE_USER']);
    
            // Hasher le mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
    
            // Enregistrer l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();
    
            // Rediriger vers la page de connexion ou un autre endroit
            return $this->redirectToRoute('login');
        }
    
        return $this->render('auth/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/forgot', name: 'forgot')]
    public function forgot(): Response
    {
        return $this->render('auth/forgot.html.twig');
    }

    #[Route(path: '/confirm', name: 'confirm')]
    public function confirm(): Response
    {
        return $this->render('auth/confirm.html.twig');
    }

    #[Route(path: '/reset', name: 'reset')]
    public function reset(): Response
    {
        return $this->render('auth/reset.html.twig');
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
}
