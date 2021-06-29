<?php

namespace App\Controller;

use App\Repository\DuckRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="ducks_index", methods={"GET"})
     */
    public function index(DuckRepository $duckRepository): Response
    {
        return $this->render('ducks/index.html.twig', [
            'ducks' => $duckRepository->findAll(),
        ]);
    }
}
