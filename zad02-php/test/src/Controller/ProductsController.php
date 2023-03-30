<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// products/getAll - get all products
// products/add - add new product
// products/get/{id} - get product with special id
// products/update/{id} - updates product with special id
// products/delete/{id} - deletes product with special id

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
        $parameters = json_decode($request->getContent(), true);

        $product = new Product();
        $product->setName($parameters['name']);
        $product->setAuthor($parameters['author']);
        $product->setPrice($parameters['price']);
        $product->setAmount($parameters['amount']);
        $product->setDescription($parameters['description']);

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
        $parameters = json_decode($request->getContent(), true);
        $tmpProduct = $productRepository->find($id);

        if (!$tmpProduct) {
            return $this->json('No product found with id' . $id, 404);
        } else {
            $tmpProduct->setName($parameters['name']);
            $tmpProduct->setAuthor($parameters['author']);
            $tmpProduct->setPrice($parameters['price']);
            $tmpProduct->setAmount($parameters['amount']);
            $tmpProduct->setDescription($parameters['description']);

            $productRepository->save( $tmpProduct, true);

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
