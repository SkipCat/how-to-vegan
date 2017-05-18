<?php

namespace Controller;

use Model\UserManager;

class SecurityController extends BaseController {

    public function editProfileAction() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!empty($_POST['username']) || !empty($_POST['email'])) {
                $manager = UserManager::getInstance();
                $user = $manager->getUserById($_SESSION['user_id']);
                $manager->editProfile($_POST);
                $this->redirect('profile&username=' . $_POST['username']);
            }
            else {
                echo $error = 'Un ou plusieurs champs requis vide(s).';
                echo $this->renderView('profile.html.twig', ['error' => $error]);
                return false;
            }
        }
        else {
            echo $this->redirect('home');
        }
    }

    public function profileAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            //$profileUser = $manager->getUserById($_GET['id']);
            //$this->redirect('profile&username=' . $user['username']);
            echo $this->renderView('profile.html.twig', [
                'user' => $user,
            ]); // get also list, recipes and comments
        }
        else {
            echo $this->redirect('home');
        }
    }

    public function loginAction() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manager = UserManager::getInstance();
            if ($manager->userCheckLogin($_POST)) {
                $manager->userLogin($_POST['username']);
                echo $this->redirect('home');
            }
            else {
                echo $result = 'Invalid username or password';
                return false;
            }
        }
        else {
            echo $this->renderView('login.html.twig', ['error' => $error]);
        }
    }

    public function logoutAction() {
        session_destroy();
        echo $this->redirect('login');
    }

    public function registerAction() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manager = UserManager::getInstance();
            if ($manager->userCheckRegister($_POST)) {
                $manager->userRegister($_POST);
                echo $this->redirect('login');
            }
            else {
                echo $result = 'Username already exist';
                return false;
            }    
        }
        else {
            echo $this->renderView('register.html.twig', ['error' => $error]);
        }
    }
}
