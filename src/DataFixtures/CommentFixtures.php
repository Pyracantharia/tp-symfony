<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Enum\CommentStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $comment = new Comment();
            $comment->setContent('This is comment number ' . $i);
            $comment->setStatus($i % 2 === 0 ? CommentStatusEnum::APPROVED : CommentStatusEnum::PENDING);
        
            // Récupérer un utilisateur fictif
            $user = $this->getReference('user-' . ($i % 10 === 0 ? 10 : $i % 10));
            $comment->setUser($user);
        
            // Récupérer un media fictif
            $media = $this->getReference('media-' . ($i % 5));
            $comment->setMedia($media);
        
            // Optionnellement, assigner un parent commentaire
            if ($i > 1) {
                $parentComment = $this->getReference('comment-' . ($i - 1));  // Assigner le commentaire précédent comme parent
                $comment->setParentComment($parentComment);
            }
        
            $manager->persist($comment);
            $this->addReference('comment-' . $i, $comment);  // Enregistrer la référence pour d'autres commentaires
        }
        

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            MediaFixtures::class,  // Assuming MediaFixtures exists
        ];
    }
}
