<?php
use App\PDOquery\PDOConnect;
require_once __DIR__ . '/vendor/autoload.php';

$dns = new PDOConnect('twig_test_db', 'root', 'admin');
$users = $dns->getUsers();
//var_dump($users);
//Указваем в какой папке будут храниться наши шаблоны
$loader = new Twig_Loader_Filesystem('templates');
//в переменной $twig хранятся данные о папке с шаблонами
$twig = new Twig_Environment($loader);

//Подгружаем файл с нашим шаблоном
$template = $twig->loadTemplate('index.html');
$title = 'Главная страница';

echo $template->render(array('title' => $title, 'users' => $users,));
//$printUser = $twig->loadTemplate('user.html');