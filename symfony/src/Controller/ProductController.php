<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    /**
     * La page d'accueil affiche la liste des produits
     * @Route("/", name="homepage")
     */
    public function homepage(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Product::class);
        $products = $repository->findAll();

        return $this->render('product/homepage.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @Route("/update/{id}", name="update")
     */
    public function createOrUpdate(?Product $product, Request $request, EntityManagerInterface $entityManager)
    {
        //Si aucun produit n'est passé à la fonction, c'est une création
        if(!$product){
        $product = new Product;
        }

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                //Pas besoin de persister pour les produits existants
                if(!$product->getId()){
                    $entityManager->persist($product);
                }
                $entityManager->flush();
                return $this->redirectToRoute('homepage');
            }

        return $this->render('product/createupdate.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }

    /**
     * Suppression par id
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(?Product $product, Request $request, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($product);
        $entityManager->flush();
        $entityManager->flush();
        return $this->redirectToRoute('homepage');
    }

}