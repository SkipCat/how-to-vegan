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
}
