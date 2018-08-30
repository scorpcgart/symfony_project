<?php
namespace App\Controller;

use App\Repositories\AdminRepository;
use App\Services\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repositories\UserRepository;

class AdminController extends AbstractController
{
    protected $adminRepository;

    protected $adminService;

    public function __construct(AdminRepository $adminRepository, AdminService $adminService)
    {
        $this->adminRepository = $adminRepository;
        $this->adminService = $adminService;
    }

    public function index($login, $pass)
    {
        $result = $this->adminRepository->checkUser($login);

        $response = $this->adminService->checkAdminPassword($result, $pass);
        if($response === false){
            return $this->render('admin/admin-error.html.twig', array());
        }
        return $this->render('admin/adminka.html.twig', array('result' => $response));
    }

}