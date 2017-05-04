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
use AppBundle\Entity\Curso;
use AppBundle\Form\CursoType;
use Symfony\Component\Validator\Constraints as Assert;

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

    public function createAction() {
      $curso = new Curso();
      $curso -> setTitulo("Curso de Symfony 3");
      $curso -> setDescripcion("Curso completo de Symfony 3");
      $curso -> setPrecio(80);

      $em = $this->getDoctrine()->getManager();
      $em ->persist($curso);
      $flush = $em -> flush();

      if ($flush != null) {
        echo "The course wasn't create correctly";
      } else {
        echo "The course was create correctly";
      }

      die();
    }

    public function readAction() {
      $em = $this->getDoctrine()->getManager();
      $cursos_repo =  $em->getRepository("AppBundle:Curso");
      $cursos = $cursos_repo->findAll();

      $curso_ochenta = $cursos_repo -> findOneByPrecio(80);
      echo $curso_ochenta -> getTitulo();

      /*foreach ($cursos as $curso) {
        echo $curso->getTitulo()."<br/>";
        echo $curso->getDescripcion()."<br/>";
        echo $curso->getPrecio()."<br/><hr/>";
      }*/

      die();
    }

    public function updateAction($id, $titulo, $descripcion, $precio) {
      $em = $this->getDoctrine()->getManager();
      $cursos_repo =  $em -> getRepository("AppBundle:Curso");

      $curso = $cursos_repo -> find($id);
      $curso -> setTitulo($titulo);
      $curso -> setDescripcion($descripcion);
      $curso -> setPrecio($precio);

      $em -> persist($curso);
      $flush = $em -> flush();

      if ($flush != null) {
        echo "The course wasn't update correctly";
      } else {
        echo "The course was update correctly";
      }

      die();
    }

    public function deleteAction($id) {
      $em = $this->getDoctrine()->getManager();
      $cursos_repo =  $em -> getRepository("AppBundle:Curso");

      $curso = $cursos_repo -> find($id);
      $em -> remove($curso);

      $flush = $em -> flush();

      if ($flush != null) {
        echo "The course wasn't delete correctly";
      } else {
        echo "The course was delete correctly";
      }

      die();
    }

    public function nativeSqlAction() {
      $em = $this->getDoctrine()->getManager();
      $cursos_repo = $em->getRepository("AppBundle:Curso");
      /*$db = $em -> getConnection();

      $query = "SELECT * FROM cursos";
      $stmt = $db -> prepare($query);
      $params = array();
      $stmt -> execute($params);

      $cursos = $stmt ->fetchAll();*/

      /*$query = $em -> createQuery("
        SELECT c FROM AppBundle:Curso c
        WHERE c.precio > :precio
      ")->setParameter("precio","79");

      $cursos = $query->getResult();*/

      /*$query = $cursos_repo -> createQueryBuilder("c")
              ->where("c.precio > :precio")
              ->setParameter("precio","79")
              ->getQuery();

      $cursos = $query->getResult();*/

      $cursos = $cursos_repo->getCursos();

      foreach ($cursos as $curso) {
        echo $curso->getTitulo()."<br/>";
      }

      die();
    }

    public function formAction(Request $request) {
      $curso = new Curso();
      $form = $this->createForm(CursoType::class,$curso);

      $form->handleRequest($request);

      if ($form->isValid()) {
        $status = "Valid Form";
        $data = array(
          "titulo" => $form->get("titulo")->getData(),
          "descripcion" => $form->get("descripcion")->getData(),
          "precio" => $form->get("precio")->getData(),
        );
      } else {
        $status = null;
        $data = null;
      }

      return $this->render('AppBundle:tests:form.html.twig', [
          'form' => $form->createView(),
          'status'=> $status,
          'data' => $data,
      ]);
    }

    public function validateEmailAction($email){
      $emailConstraint = new Assert\Email();
      $emailConstraint->message = "Give me a right email";

      $error = $this->get("validator")->validate($email, $emailConstraint);

      if (count($error) == 0) {
        echo "<h1>Valid email!!</h1>";
      } else {
        echo $error[0]->getMessage();
      }
      die();
    }

}
