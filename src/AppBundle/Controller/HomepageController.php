<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('homepage/index.html.twig');
    }

    public function mainAction(): Response
    {
        return $this->render('pages/home.html.twig');
    }
}
