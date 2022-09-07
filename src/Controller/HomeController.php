<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();

        return $this->render('home/index.html.twig', compact('articles'));
    }

    #[Route('/article/{id}', methods: ['GET'])]
    public function show($id, ArticleRepository $repo): Response
    {
        $article = $repo->find($id);

        return $this->render('home/show.html.twig', compact('article'));
    }
}
