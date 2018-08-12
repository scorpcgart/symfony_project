<?php
namespace App\Controller;

use App\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome/", name="welcome")
     */
    public function index()
    {
        $gg = "Привет";
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/welcome/{id}", name="welcome_user", requirements={"id"="\d+"})
     */
    public function user($id)
    {
        return $this->render('index.html.twig', array('name' => $id,));
    }
}