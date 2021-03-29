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

//      Pour chaque lot on récupère son adresse (lié à la vente), la date de début de la vente,
//      ainsi que le commissaire en charge de la vente.
        foreach ($lots as $lot) {
            $infosForLots[$lot->getId()]['estimationTotal'] = 0;
            $infosForLots[$lot->getId()]['estimationMoyenne'] = 0;
            if ($lot->getEncheres()->count() > 0) {
                $encheres = $lot->getEncheres();
                $enchere = $encheres->last();
                $adresse = $enchere->getSalleVente()->getAdresse();
                $dateStart = $enchere->getSalleVente()->getDateStart();
//                TODO corrigé la date ici
//                var_dump($dateStart);
                $infosForLots[$lot->getId()]['adresse'] = $adresse;
                $infosForLots[$lot->getId()]['datestart'] = $dateStart;
                $commissaire = $enchere->getSalleVente()->getCommissaire();
                $infosForLots[$lot->getId()]['commissaire'] = $commissaire;
            }

//          Pour chaque lot on va récupérer tous les produits lié afin de faire la somme des estimations des produits du lot
//          ainsi qu'une moyenne des estimations des produits du lot.
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
     * @Route("/lotvente/{id}", name="lotvente_show")
     */
    public function voirLotEnVente($id): Response
    {
//        Fonction pour voir un lot spécifique qui est mis en vente
        $infosProduit = array();
        $repo = $this->getDoctrine()->getRepository(Lot::class);
        $lot = $repo->find($id);

//        On récupère les produits liés au lot
        $produits = $lot->getProduits();

//        On boucle sur ces produits pour récupérer leurs estimations les plus récentes
        foreach ($produits as $produit) {
            $infosProduit[$produit->getId()]['estimation'] = 0;
            $estimations = $produit->getEstimations();
            if ($estimations->count() > 0) {
                $estimation = $estimations->last();
                $infosProduit[$produit->getId()]['estimation'] = $estimation->getPrixEstimation();
            }
        }

//        Pour récupérer la dernière enchère qui a été faite sur le lot
        $encheres = $lot->getEncheres();
        if ($encheres->count() > 0) {
            $lastEnchere = $encheres->last()->getPrixPropose();
        }

        return $this->render('home/show_vente.html.twig', [
            'lot' => $lot,
            'infosProduit' => $infosProduit,
            'lastEnchere' => $lastEnchere,
        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
//        Fonction pour la page d'administration "dashboard" qui donne accès à tous les CRUDs de l'application
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
