<?php

namespace App\Controller;

use App\Entity\OrdreAchat;
use App\Form\OrdreAchatType;
use App\Repository\OrdreAchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ordre/achat")
 */
class OrdreAchatController extends AbstractController
{
    /**
     * @Route("/", name="ordre_achat_index", methods={"GET"})
     */
    public function index(OrdreAchatRepository $ordreAchatRepository): Response
    {
        return $this->render('ordre_achat/index.html.twig', [
            'ordre_achats' => $ordreAchatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ordre_achat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ordreAchat = new OrdreAchat();
        $form = $this->createForm(OrdreAchatType::class, $ordreAchat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ordreAchat);
            $entityManager->flush();

            return $this->redirectToRoute('ordre_achat_index');
        }

        return $this->render('ordre_achat/new.html.twig', [
            'ordre_achat' => $ordreAchat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_achat_show", methods={"GET"})
     */
    public function show(OrdreAchat $ordreAchat): Response
    {
        return $this->render('ordre_achat/show.html.twig', [
            'ordre_achat' => $ordreAchat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ordre_achat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OrdreAchat $ordreAchat): Response
    {
        $form = $this->createForm(OrdreAchatType::class, $ordreAchat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ordre_achat_index');
        }

        return $this->render('ordre_achat/edit.html.twig', [
            'ordre_achat' => $ordreAchat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_achat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OrdreAchat $ordreAchat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordreAchat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ordreAchat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ordre_achat_index');
    }
}
