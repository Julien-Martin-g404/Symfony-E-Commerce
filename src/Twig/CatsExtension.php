<?php

namespace App\Twig;

use App\Entity\Categories; // Assurez-vous que le chemin d'accès est correct
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CatsExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('parentsCategories', [$this, 'getParentsCategories']),
            new TwigFunction('childsCategories', [$this, 'getChildsCategories'])
        ];
    }
    public function getParentsCategories()
    {
        return $this->em->getRepository(Categories::class)->findParentsCategories();
    }
    public function getChildsCategories()
    {
        return $this->em->getRepository(Categories::class)->findNotParentsCategories();
    }
}
