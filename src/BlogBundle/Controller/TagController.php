<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Tag;
use BlogBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TagController extends Controller {

    private $session;

    /**
     * TagController constructor.
     * @param $session
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    public function addAction(Request $request){
        $tag = new Tag();
        $form = $this->createForm(TagType::class,$tag);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $status = "The tag was created correctly";
            }else{
                $status = "The tag wasn't created correctly, because the form isn't valid";
            }

            $this->session->getFlashBag()->add("status",$status);
        }

        return $this->render("BlogBundle:Tag:add.html.twig",array(
            "form" => $form->createView()
        ));
    }
}
