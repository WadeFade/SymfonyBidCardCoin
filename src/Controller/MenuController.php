<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MenuController extends AbstractController
{
//    Pas de commentaire car vue partielle
    public function menu()
    {
        return $this->render('menu/_menu.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }

    public function commissaireAdmin()
    {
        return $this->render('menu/_menu_commissaire.html.twig', [
           'controller_name' => 'MenuController',
        ]);
    }

    public function adminMenu()
    {
        return $this->render('menu/_menu_admin.html.twig', [
           'controller_name' => 'MenuController',
        ]);
    }
}
