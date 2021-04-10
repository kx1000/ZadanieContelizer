<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCrudController extends Controller
{
    /**
     * @Route("/api-crud", name="api_crud")
     */
    public function index(): Response
    {
        return $this->render('api_crud/index.html.twig');
    }
}
