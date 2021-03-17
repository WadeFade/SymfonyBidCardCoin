<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();
//        Rejeter l'accès au non admin et non super admin
        if(!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles))){
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('home/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
