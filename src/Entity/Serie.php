<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie extends Media
{
    // Aucun besoin de redéfinir media ici, puisque Serie hérite de Media
}
