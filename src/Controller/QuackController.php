<?php

namespace App\Controller;

use App\Entity\Quack;
use App\Form\QuackType;
use App\Form\SearchQuackType;
use App\Repository\QuackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quack")
 */

class QuackController extends AbstractController
{
    /**
     * @Route("/", name="quack_index", methods={"GET", "POST"})
     */
    public function index(QuackRepository $quackRepository, Request $request): Response
    {
        $quacks = $quackRepository->findByDate();

        $form = $this->createForm(SearchQuackType::class);

        $search = $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $quacks = $quackRepository -> search($search->get('mots')->getData());
        }

        return $this->render('quack/index.html.twig', [
            'quacks' => $quacks,
            'form' => $form -> createView()
        ]);
    }

    /**
     * @Route("/new", name="quack_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quack = new Quack();
        $quack->setDuck($this->getUser());
        $quack->setCreatedAt(new \DateTime('now'));
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quack);
            $entityManager->flush();

            return $this->redirectToRoute('quack_index');
        }

        return $this->render('quack/new.html.twig', [
            'quack' => $quack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quack_show", methods={"GET"})
     */
    public function show(Quack $quack): Response
    {
        return $this->render('quack/show.html.twig', [
            'quack' => $quack,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quack_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quack $quack): Response
    {
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);

        $this->denyAccessUnlessGranted('quack_edit', $quack);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quack_index');
        }

        return $this->render('quack/edit.html.twig', [
            'quack' => $quack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quack_delete", methods={"POST"})
     */
    public function delete(Request $request, Quack $quack): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quack->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quack);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quack_index');
    }

    /**
     * @Route("/{id}/newComment", name="quack_newComment", methods={"GET","POST"})
     */
    public function newComment(Request $request, Quack $quack): Response
    {
        $comment = new Quack();
        $comment->setParent($quack);
        $comment->setDuck($this->getUser());
        $comment->setCreatedAt(new \DateTime('now'));
        $form = $this->createForm(QuackType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('quack_index');
        }

        return $this->render('quack/new.html.twig', [
            'quack' => $quack,
            'form' => $form->createView(),
        ]);
    }
}
