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
                $this->redirect('profile');
            }
            else {
                $error = 'Un ou plusieurs champs requis vide(s).';
                echo $this->renderView('profile.html.twig', ['error' => $error]);
            }
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
            echo $this->renderView('login_register.html.twig', ['error' => $error]);
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
            echo $this->renderView('login_register.html.twig', ['error' => $error]);
        }
    }

    public function profileAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            $lists = $manager->getAllLists($user['username']);
            $recipes = $manager->getFavorites($user['username']);
            echo $this->renderView('profile.html.twig', [
                'user'  => $user,
                'lists' => $lists,
                'recipes' => $recipes,
            ]); // get also comments
        }
        else {
            echo $this->renderView('login');
        }
    }

    public function pinAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $manager = UserManager::getInstance();
                $user = $manager->getUserById($_SESSION['user_id']);
                $list = $manager->pinList($_POST);
                echo $this->redirect('convert');
            }
            else {
                echo $this->renderView('convert.html.twig', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('login');
        }
    }

    public function deleteListAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $manager = UserManager::getInstance();
                $manager->deleteList($_POST['listname']);
                echo $this->redirect('profile');
            }
            else {
                echo $this->renderView('profile', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('login');
        }
    }

    public function crushAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $manager = UserManager::getInstance();
                $user = $manager->getUserById($_SESSION['user_id']);
                $manager->pinRecipe($_POST);
                echo $this->redirect('recipe');
            }
            else {
                echo $this->renderView('recipe.html.twig', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('login');
        }
    }

    public function deleteFavoriteAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $manager = UserManager::getInstance();
                $manager->deleteFavorite($_POST['id']);
                echo $this->redirect('profile');
            }
            else {
                echo $this->renderView('profile', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('login');
        }
    }
    
    public function adminAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            if ($user['admin'] == 'admin') {
                echo $this->renderView('admin.html.twig');
            }
            else {
                echo $this->redirect('home');
            }
        }
        else {
            echo $this->renderView('home.html.twig', ['error' => $error]);
        }
    }
}
