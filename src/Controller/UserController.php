<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\PDOquery\PDOConnect;
use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{
    /**
     *
     */
    public function index()
    {
        $pdo = new PDOConnect('twig_test_db', 'root', 'admin');
        $users = $pdo->getUsers();

        return $this->render('user/users.html.twig', array('users' => $users));
    }

    /**
     *
     */
    public function user($id)
    {
        $pdo = new PDOConnect('twig_test_db', 'root', 'admin');
        $user = $pdo->getUser($id);

        return $this->render('user/user.html.twig', array('user' => $user, 'id' => $id));
    }

    public function addUser(Request $request)
    {
        $pdo = new PDOConnect('twig_test_db', 'root', 'admin');
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        //$result = $pdo->addUser($user->getName(), $user->getLastname(), $user->getEmail());
        if($form->isSubmitted()){
            $nameUser = $user->getName();
             $userQuery = $pdo->getUserByName($nameUser);
            $pdo->addUser($user->getName(), $user->getLastname(), $user->getEmail());

            return $this->render('user/response-user.html.twig', array('user' => $userQuery, 'name' => $nameUser));
        }
        return $this->render('user/formuser.html.twig', array(
                'post' => $user,
                'form' => $form->createView(),
        ));
    }

    public function deleteUser($id)
    {
        $pdo = new PDOConnect('twig_test_db', 'root', 'admin');
        $users = $pdo->getUsers();
            $pdo->deleteUser($id);

            return $this->render('user/users.html.twig', array('users' => $users));


    }

}