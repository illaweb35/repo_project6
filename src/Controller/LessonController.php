<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Form\LessonType;
use App\Service\Pagination;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/lesson")
 */
class LessonController extends AbstractController
{
    /**
     * @Route("/{page<\d+>?1}", name="lesson_index", methods={"GET"})
     */
    public function index(Pagination $pagination, $page): Response
    {
        $pagination->setEntityClass(Lesson::class)
            ->setPage($page);
        $lessons = $pagination->getData();
        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessons,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="lesson_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $lesson = new Lesson();
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imageFile = $form['image']->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $lesson->setImage($imageFileName);
            }
            $entityManager->persist($lesson);
            $entityManager->flush();

            return $this->redirectToRoute('lesson_index');
        }

        return $this->render('lesson/new.html.twig', [
            'lesson' => $lesson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="lesson_show", methods={"GET"})
     */
    public function show(Lesson $lesson): Response
    {
        return $this->render('lesson/show.html.twig', [
            'lesson' => $lesson,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="lesson_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lesson $lesson): Response
    {
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lesson->setImage(
                new File($this->getParameter('images_directory') . '/' . $lesson->getImage())
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lesson_index');
        }

        return $this->render('lesson/edit.html.twig', [
            'lesson' => $lesson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="lesson_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lesson $lesson): Response
    {
        if ($this->isCsrfTokenValid('delete' . $lesson->getSlug(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lesson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lesson_index');
    }
}
