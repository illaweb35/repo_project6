<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\LessonRepository;
use App\Repository\ArticleRepository;
use App\Repository\ProspectRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @IsGranted("ROLE_USER")
     * 
     */
    public function index(UserRepository $users, ArticleRepository $articles, LessonRepository $lessons, ProspectRepository $prospects)
    {



        return $this->render('_dashboard/home/index.html.twig', [
            'users' => $users->findAll(),
            'articles' => $articles->findall(),
            'articlesPanel' => $articles->findByLast(5),
            'lessons' => $lessons->findByLast(5),
            'prospects' => $prospects->findAll(),
            'prospectsPanel' => $prospects->findByLast(5),
        ]);
    }
}
