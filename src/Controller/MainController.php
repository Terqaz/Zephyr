<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    /**
     * Отправляем все остальные запросы, которые не подошли ни под один роут, во vue-router
     */
    #[Route('/{path}', name: 'app_main', requirements: ['path' => '^.*'])]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }
}
