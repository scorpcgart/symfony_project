<?php
namespace App\Controller;

use App\Core\Autorization;
use App\Core\Session;
use App\Entity\Article;
use App\Entity\Authoriz;
use App\Form\ArticleType;
use App\Form\AuthorizType;
use App\Repositories\AdminRepository;
use App\Services\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repositories\UserRepository;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @var AdminRepository
     */
    protected $adminRepository;

    /**
     * @var AdminService
     */
    protected $adminService;

    public $session;

    protected $user;

    /**
     * AdminController constructor.
     * @param AdminRepository $adminRepository
     * @param AdminService $adminService
     */
    public function __construct(AdminRepository $adminRepository, AdminService $adminService, Session $session)
    {
        $this->adminRepository = $adminRepository;
        $this->adminService = $adminService;
        $this->session = $session->startSession();
    }

    public function indexAction()
    {
        if(isset($_SESSION['login'])){
            return $this->render('admin/adminka.html.twig', array('result' => $_SESSION['login']));
        }
        return $this->render('admin/admin-error.html.twig', array());
    }

    public function exitAction()
    {
        session_destroy();
        return $this->redirectToRoute('adminka_autorization');
    }


    public function checkingAutorization($login)
    {
        $session = new Session();
        $name = 'login';
        $session->setSession($name, $login);

        if($session->getSession($name) != $login){

            return $this->render('admin/admin-error.html.twig', array());
        }
        return true;
    }

    /**
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function autorizationAction(Request $request)
    {
        //$res = new Autorization();

        $authoriz = new Authoriz();
        $form = $this->createForm(AuthorizType::class, $authoriz);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $trueLogin = $this->adminRepository->checkUser($authoriz->getLogin());
            $response = $this->adminService->checkAdminPassword($trueLogin, $authoriz->getPassword());
            if($response){
                    $_SESSION['login'] = $trueLogin;
                    $this->user = $trueLogin;
                    return $this->indexAction();
                //return $this->redirectToRoute('adminka_index', array('result' => $trueLogin));
            }
            return $this->render('admin/admin-error.html.twig', array());
          //  $res->Autoriz($trueLogin);
            //$res->checkAutorization($trueLogin);
        }
        return $this->render('admin/form-authorization.html.twig', array(
            'post' => $authoriz,
            'form' => $form->createView(),
        ));

      //  if($response){
       // return $this->render('admin/form-authorization.html.twig', array());

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addArticleAction(Request $request)
    {

        $id = 6;
        $result = $this->adminRepository->getArticleById($id);
        var_dump($result);
        $title = $result['title'];
        $textarea = $result['text'];
        $article = new Article();
        $article->setTitle($title);
        $article->setText($textarea);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $this->adminRepository->addArticle($article->getTitle(), $article->getText());

            return $this->render('admin/response-article-adminka.html.twig', array(
                'title' => $article->getTitle(),
                'user' => $this->user,
                ));
        }

        return $this->render('admin/form-article-adminka.html.twig', array(
            'post' => $article,
            'form' => $form->createView(),
        ));
    }

    public function getArticlesAction()
    {
        $response = $this->adminRepository->getArticles();

        return $this->render('admin/response-article-adminka.html.twig', array(
            'articles' => $response));
    }

    public function updateArticleAction(Request $request, $id)
    {
        $result = $this->adminRepository->getArticleById($id);
        $title = $result['title'];
        $textarea = $result['text'];
        $article = new Article();
        $article->setTitle($title);
        $article->setText($textarea);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $this->adminRepository->updateArticle($id, $article->getTitle(), $article->getText());

            return $this->render('admin/response-article-adminka.html.twig', array(
                'title' => $article->getTitle(),
                'user' => $this->user,
            ));
        }

        return $this->render('admin/form-article-adminka.html.twig', array(
            'post' => $article,
            'form' => $form->createView(),
        ));
    }
}