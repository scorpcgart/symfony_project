<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        $title = "Главная страница";
        return $this->render('index.html', array('title' => $title));
    }
}
