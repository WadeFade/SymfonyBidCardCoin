<?php

namespace App\Controller;

use App\Entity\Estimation;
use App\Form\EstimationType;
use App\Repository\EstimationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estimation")
 */
class EstimationController extends AbstractController
{
    /**
     * @Route("/", name="estimation_index", methods={"GET"})
     */
    public function index(EstimationRepository $estimationRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non commissaire, non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles) || in_array('ROLE_COMMISSAIRE', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('estimation/index.html.twig', [
            'estimations' => $estimationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="estimation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non commissaire, non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles) || in_array('ROLE_COMMISSAIRE', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $estimation = new Estimation();
        $form = $this->createForm(EstimationType::class, $estimation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estimation);
            $entityManager->flush();

            return $this->redirectToRoute('estimation_index');
        }

        return $this->render('estimation/new.html.twig', [
            'estimation' => $estimation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estimation_show", methods={"GET"})
     */
    public function show(Estimation $estimation): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non commissaire, non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles) || in_array('ROLE_COMMISSAIRE', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('estimation/show.html.twig', [
            'estimation' => $estimation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="estimation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estimation $estimation): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non commissaire, non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles) || in_array('ROLE_COMMISSAIRE', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createForm(EstimationType::class, $estimation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estimation_index');
        }

        return $this->render('estimation/edit.html.twig', [
            'estimation' => $estimation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estimation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estimation $estimation): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRoles = $this->getUser()->getRoles();

//        Rejeter l'accès au non commissaire, non admin et non super admin
        if (!(in_array('ROLE_SUPER_ADMIN', $userRoles) || in_array('ROLE_ADMIN', $userRoles) || in_array('ROLE_COMMISSAIRE', $userRoles))) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        if ($this->isCsrfTokenValid('delete'.$estimation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estimation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estimation_index');
    }
}
