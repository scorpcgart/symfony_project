<?php
namespace App\Controller;

//require_once  __DIR__ .'/../Resources/config/db.yml';
use App\Db\DbConnection;
use App\Db\DbModel;
use App\Db\DbParamsDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\PDOquery\PDOConnect;
use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{
    protected $connect;
    protected $db;

    public function __construct(DbConnection $dbConnection)
    {

        $params = new DbParamsDTO();
        $params->setHost('localhost');
        $params->setDbName('twig_test_db');
        $params->setUserName('root');
        $params->setPassword('admin');
        $dbConnection->setParams($params);
        $dbConnection->connect();
        $this->connect = $dbConnection;

        //$this->db = $dbConnection->connect();
    }

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
        $load = Yaml::parseFile('../src/Resources/config/db.yml');
        $db = $load['dbname'];
        $username = $load['username'];
        $pass = $load['password'];
        //$this->db = $this->connect->
        var_dump($this->connect);
        var_dump($this->db);
        $pdo = new PDOConnect($db, $username, $pass);
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