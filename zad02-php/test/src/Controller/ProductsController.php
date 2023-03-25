<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products')]
class ProductsController extends AbstractController
{
    #[Route('/getAll', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'author' => $product->getAuthor(),
                'price' => $product->getPrice(),
                'amount' => $product->getAmount(),
                'description' => $product->getDescription(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/add', methods: ['POST'])]
    public function new(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $product->setName($request->get('name'));
        $product->setAuthor($request->get('author'));
        $product->setPrice($request->get('price'));
        $product->setAmount($request->get('amount'));
        $product->setDescription($request->get('description'));

        $productRepository->save($product, true);
        return $this->json('Created new product with id ' . $product->getId());
    }

    #[Route('/get/{id}', methods: ['GET'])]
    public function show(ProductRepository $productRepository, int $id): Response
    {
        $product = $productRepository->find($id);

        if (!$product) {
            return $this->json('No product with this id found');
        } else {
            $data = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'author' => $product->getAuthor(),
                'price' => $product->getPrice(),
                'amount' => $product->getAmount(),
                'description' => $product->getDescription(),
            ];

            return $this->json($data);
        }
    }

    #[Route('/update/{id}', methods: ['PUT'])]
    public function edit(Request $request, ProductRepository $productRepository, int $id): Response
    {
        $tmpProduct = $productRepository->find($id);

        if (!$tmpProduct) {
            return $this->json('No product found with id' . $id, 404);
        } else {
            $tmpProduct->setName($request->get('name'));
            $tmpProduct->setAuthor($request->get('author'));
            $tmpProduct->setPrice($request->get('price'));
            $tmpProduct->setAmount($request->get('amount'));
            $tmpProduct->setDescription($request->get('description'));

//            $productRepository->save( $tmpProduct, true);

            $data = [
                'id' => $tmpProduct->getId(),
                'name' => $tmpProduct->getName(),
                'author' => $tmpProduct->getAuthor(),
                'price' => $tmpProduct->getPrice(),
                'amount' => $tmpProduct->getAmount(),
                'description' => $tmpProduct->getDescription(),
            ];

            return $this->json($data);
        }
    }

    #[Route('/delete/{id}', methods: ['DELETE'])]
    public function delete(ProductRepository $productRepository, int $id): Response
    {
        $product = $productRepository->find($id);

        if (!$product){
            return $this->json('No product found with id' . $id, 404);
        } else {
            $productRepository->remove($product, true);
            return $this->json('Succesfully deleted a product with id ' . $id);
        }


    }
}
