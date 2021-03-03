<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
//    Pas de commentaire car vue partielle
    public function menu()
    {
        return $this->render('menu/_menu.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}
