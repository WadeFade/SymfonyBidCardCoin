<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Form\PaiementType;
use App\Repository\PaiementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/paiement")
 */
class PaiementController extends AbstractController
{
    /**
     * @Route("/", name="paiement_index", methods={"GET"})
     */
    public function index(PaiementRepository $paiementRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('paiement/index.html.twig', [
            'paiements' => $paiementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="paiement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $paiement = new Paiement();
        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paiement);
            $entityManager->flush();

            return $this->redirectToRoute('paiement_index');
        }

        return $this->render('paiement/new.html.twig', [
            'paiement' => $paiement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paiement_show", methods={"GET"})
     */
    public function show(Paiement $paiement): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('paiement/show.html.twig', [
            'paiement' => $paiement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="paiement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Paiement $paiement): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paiement_index');
        }

        return $this->render('paiement/edit.html.twig', [
            'paiement' => $paiement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paiement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Paiement $paiement): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        if ($this->isCsrfTokenValid('delete'.$paiement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($paiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('paiement_index');
    }
}
