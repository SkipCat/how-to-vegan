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
                echo $result = 'Pseudo ou mot de passe invalide';
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
                $error = 'Username already exist';
                echo $this->renderView('login_register.html.twig', ['error' => $error]);
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
            echo $this->redirect('login');
        }
    }

    public function editProfileAction() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!empty($_POST['username']) || !empty($_POST['email'])) {
                $manager = UserManager::getInstance();
                $user = $manager->getUserById($_SESSION['user_id']);
                $manager->editProfile($_POST);
                echo 'updated';
                //echo $this->redirect('profile');
            }
            else {
                echo $error = 'Un ou plusieurs champs requis vide(s).';
                //echo $this->renderView('profile.html.twig', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('home');
        }
    }

    public function deleteProfileAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($manager->userCheckDelete($_POST)) {
                    $user = $manager->deleteProfile($_SESSION['user_id']);
                    echo $this->redirect('register');
                }
            }
            else {
                $error = 'Votre requête n\'a pas pu aboutir';
                echo $this->renderView('profile.html.twig', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('login');
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
}
