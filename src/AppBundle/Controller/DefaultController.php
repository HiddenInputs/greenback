<?php

namespace AppBundle\Controller;

use Rinvex\Country\Loader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $northAmerica = Loader::where('geo.continent', ['NA' => 'North America']);
        $europe = Loader::where('geo.continent', ['EU' => 'Europe']);

        $x = array_merge($europe,$northAmerica);
        foreach ($x as $k => $v) {
            dump($v['name']['common']);
        }
        die;
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
