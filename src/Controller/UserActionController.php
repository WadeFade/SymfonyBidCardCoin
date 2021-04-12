<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserActionController extends AbstractController
{
    /**
     * @Route("/user/produit", name="user_produit")
     */
    public function index(): Response
    {
        return $this->render('user_action/index.html.twig', [
            'controller_name' => 'UserActionController',
        ]);
    }

    /**
     * @Route("/user/produit/new", name="user_produit_new")
     */
    public function newProduct(): Response
    {
        return $this->render('user_action/new_produit.html.twig', [
            'controller_name' => 'UserActionController',
        ]);
    }
}
