<?php
namespace AppBundle\Twig;

class ViewFilter extends \Twig_Extension {

  public function getFilters(){
    return array(
      new \Twig_SimpleFilter("addText", array($this,'addText'))
    );
  }

  public function addText($string, $num) {
    return $string." Concatenated Text".$num;
  }

  public function getName(){
    return "view_filter";
  }

}

?>
