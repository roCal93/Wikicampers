<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestDatabaseController extends AbstractController
{
    #[Route('/test/database', name: 'app_test_database')]
    public function index(): Response
    {
        return $this->render('test_database/index.html.twig', [
            'controller_name' => 'TestDatabaseController',
        ]);
    }
}
