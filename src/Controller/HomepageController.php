<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $allProducts = $produitsRepository->findAll();

        return $this->render('base.html.twig', [
            'allProducts' => $allProducts,
        ]);
    }
}
