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
        //return $this->redirect($request.getBaseUrl()."/hello-world?hello=true");
        // replace this example code with whatever you need
        /*var_dump($request->query->get("hello"));
        var_dump($request->get("hola-post"));
        die();*/
        $products = array(
                    array("product"=>"Console 1","price"=>2),
                    array("product"=>"Console 2","price"=>3),
                    array("product"=>"Console 3","price"=>4),
                    array("product"=>"Console 4","price"=>5),
                    array("product"=>"Console 5","price"=>6)
                    );
        $fruits = array("apple" => "golden","pear" => "delicius");

        return $this->render('AppBundle:tests:index.html.twig', [
            'text' => $name." - ".$page,
            'products' => $products,
            'fruits' => $fruits
        ]);
    }

}