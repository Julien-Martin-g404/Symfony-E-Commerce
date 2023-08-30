<?php

namespace App\Controller;

use App\Repository\CarrouselRepository;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategoriesRepository $categoriesRepository, CarrouselRepository $carrouselRepository): Response
    {

        $parentsCategories = $categoriesRepository->findParentsCategories();
        $childsCategories = $categoriesRepository->findNotParentsCategories();

        return $this->render('main/index.html.twig', [
            'parentsCategories' => $parentsCategories,
            'childsCategories' => $childsCategories,
            'carrousels' => $carrouselRepository->findAll()
        ]);
    }
}