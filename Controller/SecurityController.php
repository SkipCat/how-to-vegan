<?php

namespace Controller;

use Model\UserManager;

class SecurityController extends BaseController {

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
                echo $this->redirect('home');
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
