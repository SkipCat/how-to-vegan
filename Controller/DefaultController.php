<?php

namespace Controller;

use Model\UserManager;

class DefaultController extends BaseController {

    //echo mysqli_client_encoding();
    
    public function homeAction() {
        $manager = UserManager::getInstance();
        $baskets = $manager->getAllBaskets();
        $recipes = $manager->getAllRecipes();

        if (!empty($_SESSION['user_id'])) {
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('home.html.twig', [
                'user'    => $user,
                'baskets' => $baskets,
                'recipes' => $recipes
            ]);
        }
        else {
            echo $this->renderView('home.html.twig', [
                'baskets' => $baskets,
                'recipes' => $recipes
            ]);
        }
    }

    public function convertAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('convert.html.twig', ['user' => $user]);
        }
        else {
            echo $this->renderView('convert.html.twig');
        }
    }

    public function basketAction() {
        $manager = UserManager::getInstance();
        $baskets = $manager->getAllBaskets();
        $ingredients = $manager->getAllIngredients();

        if (!empty($_SESSION['user_id'])) {
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('basket.html.twig', [
                'user' => $user,
                'baskets' => $baskets,
                'ingredients' => $ingredients
            ]);
        }
        else {
            echo $this->renderView('basket.html.twig', [
                'baskets' => $baskets,
                'ingredients' => $ingredients
            ]);
        }
    }

    public function recipeAction() {
        $manager = UserManager::getInstance();
        $recipes = $manager->getAllRecipes();

        if (!empty($_SESSION['user_id'])) {
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('recipe.html.twig', [
                'user' => $user,
                'recipes' => $recipes
            ]);
        }
        else {
            echo $this->renderView('recipe.html.twig', ['recipes' => $recipes]);
        }
    }

    public function contactAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('contact.html.twig', ['user' => $user]);
        }
        else {
            echo $this->renderView('contact.html.twig');
        }
    }

    public function aboutAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('about.html.twig',
                ['user' => $user]);
        }
        else {
            echo $this->renderView('about.html.twig');
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
            echo $this->redirect('home');
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
            echo $this->redirect('convert');
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
            echo $this->redirect('home');
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
            echo $this->redirect('recipe');
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
            echo $this->redirect('home');
        }
    }
}
