<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index(Request $request)
    {
        $product = new Product();
        $product->setCompany($this->getUser()->getCompany());
        $productForm = $this->createForm(ProductFormType::class,$product);

        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
        }

        $products = $this->getDoctrine()->getRepository(Product::class)
            ->findAll();

        return $this->render('products/index.html.twig', [
            'productForm'=>$productForm->createView(),
            'products'=>$products
        ]);
    }

    /**
     * @Route("/products/{id}", name="edit_product")
     */
    public function edit(Request $request, int $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)
            ->find($id);

        return $this->render('products/edit.html.twig', [
            'product'=>$product,
        ]);
    }
}
