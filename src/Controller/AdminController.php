<?php
namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repositories\AdminRepository;
use App\Services\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repositories\UserRepository;
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

    /**
     * AdminController constructor.
     * @param AdminRepository $adminRepository
     * @param AdminService $adminService
     */
    public function __construct(AdminRepository $adminRepository, AdminService $adminService)
    {
        $this->adminRepository = $adminRepository;
        $this->adminService = $adminService;
    }

    /**
     * @param $login
     * @param $pass
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($login, $pass)
    {
        $result = $this->adminRepository->checkUser($login);

        $response = $this->adminService->checkAdminPassword($result, $pass);
        if(!$response){
            return $this->render('admin/admin-error.html.twig', array());
        }
        return $this->render('admin/adminka.html.twig', array('result' => $response));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addArticleAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $this->adminRepository->addArticle($article->getTitle(), $article->getText());

            return $this->render('admin/response-article-adminka.html.twig', array('title' => $article->getTitle()));
        }

        return $this->render('admin/form-article-adminka.html.twig', array(
            'post' => $article,
            'form' => $form->createView(),
        ));
    }

    public function getArticlesAction()
    {
        $response = $this->adminRepository->getArticles();

        return $this->render('admin/response-article-adminka.html.twig', array('articles' => $response));
    }



}