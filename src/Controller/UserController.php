<?php
namespace App\Controller;

use App\Repositories\UserRepository;
use App\Services\EditorUserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{

    protected $userRepository;

    protected $userService;

    public function __construct(UserRepository $userRepository, EditorUserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     *
     */
    public function index()
    {
        $users = $this->userRepository->getUsers();

        return $this->render('user/users.html.twig', array('users' => $users));
    }

    /**
     *
     */
    public function user($id)
    {
        $user = $this->userService->getUsers($id);

        return $this->render('user/user.html.twig', array('user' => $user, 'id' => $id));
    }

    public function addUser(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $this->userRepository->addUser($user->getName(),$user->getLastname(),$user->getEmail());

            return $this->render('user/response-user.html.twig', array('lastname' => $user->getLastname(), 'name' => $user->getName()));
        }
        return $this->render('user/formuser.html.twig', array(
                'post' => $user,
                'form' => $form->createView(),
        ));
    }

    public function deleteUser($id)
    {
       $userDeleting = $this->userRepository->getNameUserById($id);
       $this->userRepository->deleteUser($id);

       return $this->render('user/response-user.html.twig', array('userDeleting' => $userDeleting));
    }

}