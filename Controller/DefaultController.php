<?php

namespace Controller;

use Model\UserManager;

class DefaultController extends BaseController {
    
    public function homeAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('home.html.twig', ['user' => $user]);
        }
        else {
            echo $this->renderView('home.html.twig');
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
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            $baskets = $manager->getAllBaskets();
            echo $this->renderView('basket.html.twig', [
                'user' => $user,
                'baskets' => $baskets
            ]);
        }
        else {
            $manager = UserManager::getInstance();
            $baskets = $manager->getAllBaskets();
            echo $this->renderView('basket.html.twig', ['baskets' => $baskets]);
        }
    }

    public function recipeAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            $recipes = $manager->getAllRecipes();
            echo $this->renderView('recipe.html.twig', [
                'user' => $user,
                'recipes' => $recipes
            ]);
        }
        else {
            $manager = UserManager::getInstance();
            $recipes = $manager->getAllRecipes();
            echo $this->renderView('recipe.html.twig', ['recipes' => $recipes]);
        }
    }

    public function profileAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('profile.html.twig', ['user' => $user]); // get also list, recipes and comments
        }
        else {
            echo $this->renderView('profile.html.twig');
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
