<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shoppingList')]
class ShoppingListController extends AbstractController
{
    #[Route('/shopping/list', name: 'app_shopping_list')]
    public function index(): Response
    {
        return $this->render('shopping_list/index.html.twig', [
            'controller_name' => 'ShoppingListController',
        ]);
    }

//     #[Route('/getAll', name: 'app_shopping_list', methods: ['GET'])]
//     public function index(ShoppingListController $shoppingListRepository): Response
//     {
//         return $this->render('sho/index.html.twig', [
//             'shoppingList' => $shoppingListRepository->findAll(),
//         ]);
//     }

}
