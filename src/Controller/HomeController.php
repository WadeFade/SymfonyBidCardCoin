<?php

namespace App\Controller;

use App\Entity\Lot;
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
        $repo = $this->getDoctrine()->getRepository(Lot::class);
//        TODO find par date, récupérer les dates des ventes récentes(en cours) et surtout pas fini (aucune enchère adjugé ou date de fin pas passé).
        $lots = $repo->findAll();
        $infosForLots = array();
        $numProduits = array();
        foreach ($lots as $lot) {
            $infosForLots[$lot->getId()]['estimationTotal'] = 0;
            $infosForLots[$lot->getId()]['estimationMoyenne'] = 0;
            if ($lot->getEncheres()->count() > 0) {
                $encheres = $lot->getEncheres();
                $enchere = $encheres->last();
                $adresse = $enchere->getSalleVente()->getAdresse();
                $infosForLots[$lot->getId()]['adresse'] = $adresse;
                $commissaire = $enchere->getSalleVente()->getCommissaire();
                $infosForLots[$lot->getId()]['commissaire'] = $commissaire;
            }
            $produits = $lot->getProduits();
            $nbProduit = $lot->getProduits()->count();
            $numProduits[$lot->getId()] = $nbProduit;
            foreach ($produits as $produit) {
                if ($produit->getEstimations()->count() > 0) {
                    $estimations = $produit->getEstimations();
                    $estimation = $estimations->last()->getPrixEstimation();
                    $infosForLots[$lot->getId()]['estimationTotal'] += $estimation;
                }
            }
            if ($infosForLots[$lot->getId()]['estimationTotal'] != 0 && $nbProduit > 0) {
                $infosForLots[$lot->getId()]['estimationMoyenne'] = ($infosForLots[$lot->getId()]['estimationTotal'] / $nbProduit);
            }
        }

        return $this->render('home/index.html.twig',
            ['lots' => $lots,
                'infosForLots' => $infosForLots,
            ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public
    function dashboard(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();
//        Rejeter l'accès au non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('home/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
