<?php
namespace App\Services;

use App\Repositories\AdminRepository;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Core\Session;
use Symfony\Component\HttpFoundation\Request;

class AdminService
{
    private $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateArticleAction(Request $request)
    {
        $result = $this->adminRepository->getArticleById($id);
        var_dump($result);
        $title = $result['title'];
        $textarea = $result['text'];

        $article = new Article();
        $article->setTitle($title);
        $article->setText($textarea);

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class)
            ->add('textarea', TextareaType::class)
        ;
        return $this->render('admin/admin-error.html.twig', array('form' => $form->createView()));
    }


}