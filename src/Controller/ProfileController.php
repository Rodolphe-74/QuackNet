<?php

namespace App\Controller;

use App\Entity\Duck;
use App\Form\DuckType;
use App\Repository\QuackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */

class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="profile")
     */
    public function index(QuackRepository $quackRepository): Response
    {
        $quacks = $quackRepository->findAll();

        return $this->render('profile/index.html.twig', [
            'Duck' => $this->getUser(),
            'quacks' => $quacks,
        ]);
    }

    /**
     * @Route("/edit", name="profile_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $form = $this->createForm(DuckType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/edit.html.twig', [
            'duck' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{duckname}", name="profile_id", methods={"GET","POST"})
     */
    public function user(QuackRepository $quackRepository, Duck $duck): Response
    {
        $quacks = $quackRepository->findAll();

        return $this->render('profile/index.html.twig', [
            'Duck' => $duck,
            'quacks' => $quacks,
        ]);
    }
}
