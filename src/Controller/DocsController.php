<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DocsController extends AbstractController
{
    #[Route('/', name: 'app_docs')]
    public function index(): Response
    {
        return $this->redirectToRoute('api_doc');
    }
}
