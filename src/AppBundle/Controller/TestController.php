<?php
/**
 * Created by PhpStorm.
 * User: adrian_ayarde
 * Date: 16/03/17
 * Time: 23:31
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{

    public function indexAction(Request $request, $name, $page)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:tests:index.html.twig', [
            'text' => $name." - ".$page,
        ]);
    }

}