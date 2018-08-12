<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\UserController;
use App\Controller\WelcomeController;


$welcome = new RouteCollection();
$welcome->add('welcome', new Route('/welcome', array('_controller' => [WelcomeController::class, 'index'])));
$welcome->add('welcome_user', new Route('/welcome/{id}', array('_controller' => [WelcomeController::class, 'user'])));
$welcome->add('users', new Route('/users', array('_controller' => [UserController::class, 'index'])));
$welcome->add('user', new Route('/user/{id}', array('_controller' => [UserController::class, 'user'])));


return $welcome;