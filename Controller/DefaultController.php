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
            echo $this->renderView('basket.html.twig', ['user' => $user]);
        }
        else {
            echo $this->renderView('basket.html.twig');
        }
    }

    public function recipeAction() {
        if (!empty($_SESSION['user_id'])) {
            $manager = UserManager::getInstance();
            $user = $manager->getUserById($_SESSION['user_id']);
            echo $this->renderView('recipe.html.twig', ['user' => $user]);
        }
        else {
            echo $this->renderView('recipe.html.twig');
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
