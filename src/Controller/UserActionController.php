<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Form\ProduitUserType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserActionController extends AbstractController
{
    /**
     * @Route("/user/produit", name="user_produit")
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        //        On récupère l'utilisateur pour afficher ses produits.
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($this->getUser()->getId());

        return $this->render('user_action/index.html.twig', [
            'produits' => $produitRepository->findBy(['vendeur' => $user]),
        ]);
    }

    /**
     * @Route("/user/produit/new", name="user_produit_new")
     */
    public function newProduct(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitUserType::class, $produit);
        $form->handleRequest($request);
//        On récupère l'utilisateur qui ajoute un produit.
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($this->getUser()->getId());

        if ($form->isSubmitted() && $form->isValid()) {

            $produit->setVendeur($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('user_produit');
        }

        return $this->render('user_action/new_produit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }
}
