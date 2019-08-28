<?php

namespace App\Service;

use Twig\Environment;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;

class Pagination

{
    private $entityClass;
    private $limit = 8;
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;
    private $templatePath;

    /**
     * Constructor Class
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param \Twig\Environment $twig
     * @param \Symfony\Component\HttpFoundation\RequestStack $request
     */
    public function __construct(ObjectManager $manager, Environment $twig, RequestStack $request, $templatePath)
    {
        $this->manager = $manager;
        $this->twig = $twig;
        $this->route = $request->getCurrentRequest()->attributes->get('_route');
        $this->templatePath = $templatePath;
    }
    /**
     * Return the display template
     *
     * @return void
     */
    public function display()
    {

        $this->twig->display($this->templatePath, [
            'page' => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route,
        ]);
    }

    /**
     * Count nb Pages 
     *
     * @return void
     */
    public function getPages()
    {
        if (empty($this->entityClass)) {
            throw new \Exception("You did not specify the entity on which we need to page !! Use the setEntityClass method of your Pagination object");
        }
        $total = count($this->manager->getRepository($this->entityClass)->findAll());
        $pages = ceil($total / $this->limit);
        return $pages;
    }

    /**
     * Return data EntityClass
     *
     * @return void
     */
    public function getData()
    {
        if (empty($this->entityClass)) {
            throw new \Exception("You did not specify the entity on which we need to page !! Use the setEntityClass method of your Pagination object");
        }
        $offset = $this->currentPage * $this->limit - $this->limit;
        $data = $this->manager->getRepository($this->entityClass)->findBy([], [], $this->limit, $offset);
        return $data;
    }


    public function getTemplatePath()
    {
        return $this->templatePath;
    }
    public function SetTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
        return $this;
    }
    public function getentityClass()
    {
        return $this->entityClass;
    }
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }


    public function getPage()
    {
        return $this->currentPage;
    }

    public function setPage($page)
    {
        $this->currentPage = $page;
        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }
}
