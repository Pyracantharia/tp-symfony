<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Subscription;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création de plusieurs utilisateurs fictifs
        for ($i = 0; $i <= 10; $i++) {
            $user = new User();
            $user->setUsername('user' . $i);
            $user->setEmail('user' . $i . '@example.com');
        
            // Hacher le mot de passe
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($hashedPassword);
        
            // Définir un statut de compte fictif
            $status = $i % 2 === 0 ? UserAccountStatusEnum::ACTIVE : UserAccountStatusEnum::INACTIVE;
            $user->setAccountStatus($status);
        
            // Récupérer une souscription fictive créée dans SubscriptionFixtures
            $subscription = $this->getReference('subscription-' . ($i % 3));
            $user->setCurrentSubscription($subscription);

            $role = $i % 2 === 0 ? ['USER'] : ['ADMIN'];
            $user->setRoles($role);
        
            $manager->persist($user);
        
            // Ajout de la référence de l'utilisateur
            $this->addReference('user-' . $i, $user);
        }
        
        $manager->flush();
        
    }

    // Dépendance sur les fixtures de Subscription pour créer la relation ManyToOne
    public function getDependencies(): array
    {
        return [
            SubscriptionFixtures::class,
        ];
    }
}
