<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Service\Pagination;
use App\Repository\UserRepository;
use App\Repository\DanceRepository;
use App\Repository\LessonRepository;
use App\Repository\MemberRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProspectRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_USER")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="dashboard")
     * 
     */
    public function index(UserRepository $users, ArticleRepository $articles, LessonRepository $lessons, ProspectRepository $prospects, MemberRepository $members)
    {
        return $this->render('dashboard/home/index.html.twig', [
            'users' => $users->findAll(),
            'articles' => $articles->findall(),
            'articlesPanel' => $articles->findByLast(5),
            'lessonsPanel' => $lessons->findByLast(5),
            'prospects' => $prospects->findAll(),
            'prospectsPanel' => $prospects->findByLast(5),
            'members' => $members->findAll(),
            'membersPanel' => $members->findByLast(5),
        ]);
    }

    /**
     * Return Articles liste
     * @Route("/admin/articles", name="admin_articles")
     * 
     * @param \App\Repository\ArticleRepository $articles
     *
     * @return void
     */
    public function articleIndex(ArticleRepository $articles, CategoryRepository $categories)
    {
        return $this->render('article/admin_index.html.twig', [
            'articles' => $articles->findAll(),
            'categories' => $categories->findAll()
        ]);
    }
    /**
     * Return Lessons liste
     * @Route("/admin/lessons{page<\d+>?1}", name="admin_lessons"), method={"GET"})
     * 
     * @param \App\Repository\LessonRepository $lessons
     *
     * @return void
     */
    public function lessonIndex(Pagination $pagination, $page)
    {
        $pagination->setEntityClass(Lesson::class)
            ->setPage($page);
        $lessons = $pagination->getData();
        return $this->render('lesson/admin_index.html.twig', [
            'lessons' => $lessons,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/dance", name="admin_dance", methods={"GET"})
     */
    public function danceIndex(DanceRepository $danceRepository)
    {
        return $this->render('dance/admin_index.html.twig', [
            'dances' => $danceRepository->findAll(),
        ]);
    }
}
