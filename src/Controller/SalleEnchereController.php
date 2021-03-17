<?php

namespace App\Controller;

use App\Entity\SalleEnchere;
use App\Form\SalleEnchereType;
use App\Repository\SalleEnchereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salle/enchere")
 */
class SalleEnchereController extends AbstractController
{
    /**
     * @Route("/", name="salle_enchere_index", methods={"GET"})
     */
    public function index(SalleEnchereRepository $salleEnchereRepository): Response
    {
        return $this->render('salle_enchere/index.html.twig', [
            'salle_encheres' => $salleEnchereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="salle_enchere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $salleEnchere = new SalleEnchere();
        $form = $this->createForm(SalleEnchereType::class, $salleEnchere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salleEnchere);
            $entityManager->flush();

            return $this->redirectToRoute('salle_enchere_index');
        }

        return $this->render('salle_enchere/new.html.twig', [
            'salle_enchere' => $salleEnchere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salle_enchere_show", methods={"GET"})
     */
    public function show(SalleEnchere $salleEnchere): Response
    {
        return $this->render('salle_enchere/show.html.twig', [
            'salle_enchere' => $salleEnchere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="salle_enchere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SalleEnchere $salleEnchere): Response
    {
        $form = $this->createForm(SalleEnchereType::class, $salleEnchere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salle_enchere_index');
        }

        return $this->render('salle_enchere/edit.html.twig', [
            'salle_enchere' => $salleEnchere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salle_enchere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SalleEnchere $salleEnchere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salleEnchere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salleEnchere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salle_enchere_index');
    }
}
