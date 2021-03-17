<?php

namespace App\Controller;

use App\Entity\Stockage;
use App\Form\StockageType;
use App\Repository\StockageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stockage")
 */
class StockageController extends AbstractController
{
    /**
     * @Route("/", name="stockage_index", methods={"GET"})
     */
    public function index(StockageRepository $stockageRepository): Response
    {
        return $this->render('stockage/index.html.twig', [
            'stockages' => $stockageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="stockage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stockage = new Stockage();
        $form = $this->createForm(StockageType::class, $stockage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stockage);
            $entityManager->flush();

            return $this->redirectToRoute('stockage_index');
        }

        return $this->render('stockage/new.html.twig', [
            'stockage' => $stockage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stockage_show", methods={"GET"})
     */
    public function show(Stockage $stockage): Response
    {
        return $this->render('stockage/show.html.twig', [
            'stockage' => $stockage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stockage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Stockage $stockage): Response
    {
        $form = $this->createForm(StockageType::class, $stockage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stockage_index');
        }

        return $this->render('stockage/edit.html.twig', [
            'stockage' => $stockage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stockage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Stockage $stockage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stockage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stockage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stockage_index');
    }
}
