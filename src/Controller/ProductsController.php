<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProductFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {

        $product = new Produits();
        $productForm = $this->createForm(ProductFormType::class, $product);
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()){
            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
        }

        return $this->render('products/index.html.twig', [
            'form'=>$productForm->createView()
        ]);
    }


}
