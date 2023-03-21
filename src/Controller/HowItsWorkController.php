<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HowItsWorkController extends AbstractController
{
    #[Route('/howitswork', name: 'how_its_work')]
    public function index(): Response
    {
        return $this->render('how_its_work.html.twig');
    }
}
