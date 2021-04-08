<?php

namespace App\Controller;

use App\Entity\Enchere;
use App\Entity\Lot;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $lots = $repo->findAll();
//        TODO find par date, récupérer les dates des ventes récentes(en cours) et surtout pas fini (aucune enchère adjugé ou date de fin pas passé).
//        $lots = $repo->findByStartedAndNotEnded();
//
//        Pour calculer la somme des estimations des produits appartenants à chaque lot, afin d'avoir une estimation des lots.
        $estimationLots = array();
        if (!is_null($lots)) {
            foreach ($lots as $lot) {
                $estimationLots[$lot->getId()] = 0;
                foreach ($lot->getProduits() as $produit) {
                    if (!is_null($produit->getEstimations())) {
                        $prixEstimation = $produit->getEstimations()->last()->getPrixEstimation();
                        $estimationLots[$lot->getId()] += $prixEstimation;
                    }
                }
            }
        }

        return $this->render('home/index.html.twig', [
            'lots' => $lots,
            'estimationLots' => $estimationLots,
        ]);
    }

    /**
     * @Route("/lotvente/{id}", name="lotvente_show")
     */
    public function voirLotEnVente($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Lot::class);
        $lot = $repo->find($id);

        $estimationLot = 0;
        $prixDepart = 0;
        foreach ($lot->getProduits() as $produit) {
            $prixDepart += $produit->getPrixDepart();
            if (!is_null($produit->getEstimations())) {
                $prixEstimation = $produit->getEstimations()->last()->getPrixEstimation();
                $estimationLot += $prixEstimation;
            }
        }

//        ID user actuel
        $idActualUser = $this->getUser()->getId();

        return $this->render('home/show_vente.html.twig', [
            'lot' => $lot,
            'idActualUser' => $idActualUser,
            'estimationLot' => $estimationLot,
            'prixDepart' => $prixDepart,
        ]);
    }

    /**
     * @Route("/lotvente/encherir/{idLot}", name="encherir_lot")
     * @param $idLot
     * @return RedirectResponse
     */
    public function encherir($idLot): RedirectResponse
    {
//        TODO sécurité : vérifier que le lot est encore en vente

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//        Valeur par défaut à ajouter à l'enchère
        $toAdd = 20.00;
//        Instanciation d'un nouvel objet de type Enchere pour enchérir sur le lot actuel
        $newEnchere = new Enchere();

//        On récupère l'utilisateur qui va enchérir
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($this->getUser()->getId());

//        On récupère le lot
        $repoLot = $this->getDoctrine()->getRepository(Lot::class);
        $lot = $repoLot->find($idLot);


//        On set les datas du nouvel objet de type enchere
        $newEnchere->setDateEnchere(new \DateTimeImmutable("now"));
        $newEnchere->setLot($lot);
        $newEnchere->setEncherisseur($user);

//        S'il n'y avait pas encore d'enchère sur le lot alors la première enchère sera faite selon le prix de départ.
        if (!$lot->getEncheres()->last()) {
            $prixDepart = 0;
            foreach ($lot->getProduits() as $produit) {
                $prixDepart += $produit->getPrixDepart();
            }
            $newEnchere->setPrixPropose($prixDepart);
        } else {
            $newEnchere->setPrixPropose($lot->getEncheres()->last()->getPrixPropose() + $toAdd);
        }
        $newEnchere->setCommissaire($lot->getVente()->getCommissaire());
        $newEnchere->setEstAdjuge(false);

//        On appel l'entity manager pour préparer l'insert en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($newEnchere);
//        On exécute la query
        $em->flush();

//        Et on redirige sur la page d'origine
        return $this->redirectToRoute('lotvente_show', ['id' => $idLot]);
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
