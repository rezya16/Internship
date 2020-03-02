<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\ProductType;
use http\Env\Response;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Zend\Diactoros\Request;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setTitle('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // relates this product to the category
        $product->setIdCategory($category);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->persist($product);
        $entityManager->flush();

        return new \Symfony\Component\HttpFoundation\Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }

    /**
     * @Route("/product/new", name="new")
     */
    public function new(\Symfony\Component\HttpFoundation\Request $request) {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute("new");
        }

        return $this->render("product/new.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function findProductByID($id) {
        $product = $this->getDoctrine()->getRepository(Product::class)
        ->find($id);

        return $this->render('product/find.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/product/update/{id}")
     */
    public function update($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setTitle('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }
}
