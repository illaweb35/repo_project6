<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articles)
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articles->findByCategory('news', '4'),
        ]);
    }

    /**
     * @Route("/mentions_legals", name="mentions_legals")
     *
     * @return void
     */
    public function mentionsLegals()
    {
        return $this->render('mentions_legals/legals.html.twig');
    }
    /**privacy", name="privacy")
     *
     * @return void
     */
    public function privacy()
    {
        return $this->render('mentions_legals/privacy.html.twig');
    }
}
