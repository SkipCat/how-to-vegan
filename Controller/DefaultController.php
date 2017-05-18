<?php

namespace Controller;

use Model\UserManager;

class DefaultController extends BaseController {
    
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

    public function basketAction() {
        $manager = UserManager::getInstance();
        $baskets = $manager->getAllBaskets();

        if (!empty($_SESSION['user_id'])) {
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('basket.html.twig', [
                'user' => $user,
                'baskets' => $baskets
            ]);
        }
        else {
            echo $this->renderView('basket.html.twig', ['baskets' => $baskets]);
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

    public function filterRecipeAction() {
        $manager = UserManager::getInstance();
        $recipes = $manager->getAllRecipes();
        $filters = $manager->getRecipeFilters($_POST);
        var_dump($filters);

        if (!empty($_SESSION['user_id'])) {
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('recipe.html.twig', [
                'user' => $user,
                'recipes' => $recipes,
                'filters' => $filters,
            ]);
        }
        else {
            echo $this->renderView('recipe.html.twig', [
                'recipes' => $recipes,
                'filters' => $filters
            ]);
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
}
