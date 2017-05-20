<?php

namespace Controller;

use Model\UserManager;
use Model\AdminManager;

class AdminController extends BaseController {

    public function adminAction() {
        if (!empty($_SESSION['user_id'])) {
            $userManager = UserManager::getInstance();
            $adminManager = AdminManager::getInstance();
            $admin = $userManager->getUserById($_SESSION['user_id']);
            $users = $adminManager->getAllUsers();
            $recipes = $userManager->getAllRecipes();
            $baskets = $userManager->getAllBaskets();
            $ingredients = $userManager->getAllIngredients();

            if ($admin['admin'] == 'admin' || $admin['admin'] == 'superadmin') {
                echo $this->renderView('admin.html.twig', [
                    'users'       => $users,
                    'admin'       => $admin,
                    'recipes'     => $recipes,
                    'baskets'     => $baskets,
                    'ingredients' => $ingredients,
                ]);
            }
            else {
                echo $this->redirect('home');
            }
        }
        else {
            echo $this->redirect('home');
        }
    }

    public function deleteUserAction() {
        $error = '';
        $userManager = UserManager::getInstance();
        $adminManager = AdminManager::getInstance();
        $admin = $userManager->getUserById($_SESSION['user_id']);

        if (!empty($_SESSION['user_id']) && $admin['admin'] == 'admin' || $admin['admin'] == 'superadmin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = $userManager->getUserByUsername($_POST['username']);
                $adminManager->deleteUser($user['username']);
                echo $this->redirect('admin');
            }
            else {
                echo $this->renderView('admin.html.twig', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('home');            
        }
    }

    public function addAdminAction() {
        $error = '';
        $userManager = UserManager::getInstance();
        $adminManager = AdminManager::getInstance();
        $admin = $userManager->getUserById($_SESSION['user_id']);

        if (!empty($_SESSION['user_id']) && $admin['admin'] == 'admin' || $admin['admin'] == 'superadmin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = $userManager->getUserByUsername($_POST['username']);
                if ($user['admin'] !== 'admin' && $user['admin'] !== 'superadmin') {
                    $adminManager->addAdmin($user['username']);
                    echo $this->redirect('admin');
                }
                else {
                    $error = 'Cet utilisateur est déjà administrateur';
                    echo $this->renderView('admin.html.twig', ['error' => $error]);
                }
            }
            else {
                echo $this->renderView('admin.html.twig', ['error' => $error]);
            }
        }
        else {
            echo $this->redirect('home');            
        }
    }

    public function addBasketAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userManager = UserManager::getInstance();
                $adminManager = AdminManager::getInstance();
                $user = $userManager->getUserById($_SESSION['user_id']);

                if ($user['admin'] == 'admin' || $user['admin'] == 'superadmin') {
                    $adminManager->addBasket($_POST);
                    echo $this->redirect('admin');
                }
                else {
                    echo $this->redirect('home');
                }
            }
        }
        else {
            echo $this->redirect('login');
        }
    }

    public function addRecipeAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userManager = UserManager::getInstance();
                $adminManager = AdminManager::getInstance();
                $user = $userManager->getUserById($_SESSION['user_id']);

                if ($user['admin'] == 'admin' || $user['admin'] == 'superadmin') {
                    $adminManager->addRecipe($_POST);
                    echo $this->redirect('admin');
                }
                else {
                    echo $this->redirect('home');
                }
            }
        }
        else {
            echo $this->redirect('login');
        }
    }

    public function addIngredientAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userManager = UserManager::getInstance();
                $adminManager = AdminManager::getInstance();
                $user = $userManager->getUserById($_SESSION['user_id']);

                if ($user['admin'] === 'admin' || $user['admin'] == 'superadmin') {
                    $adminManager->addIngredient($_POST);
                    echo $this->redirect('admin');
                }
                else {
                    echo $this->redirect('home');
                }
            }
        }
        else {
            echo $this->renderView('login');
        }
    }

    public function deleteBasketAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
                $userManager = UserManager::getInstance();
                $adminManager = AdminManager::getInstance();            
                $user = $userManager->getUserById($_SESSION['user_id']);

                if ($user['admin'] == 'admin' || $user['admin'] == 'superadmin') {
                    $adminManager->deleteBasket($_POST['name_delete_basket']);
                    echo $this->redirect('admin');
                }
                else {
                    echo $this->redirect('home');
                }
            }
        }
        else {
            echo $this->redirect('login');
        }
    }

    public function deleteRecipeAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
                $userManager = UserManager::getInstance();
                $adminManager = AdminManager::getInstance();            
                $user = $userManager->getUserById($_SESSION['user_id']);

                if ($user['admin'] == 'admin' || $user['admin'] == 'superadmin') {
                    $adminManager->deleteRecipe($_POST['name_delete_recipe']);
                    echo $this->redirect('admin');
                }
                else {
                    echo $this->redirect('home');
                }
            }
        }
        else {
            echo $this->redirect('login');
        }
    }

    public function deleteIngredientAction() {
        $error = '';
        if (!empty($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
                $userManager = UserManager::getInstance();
                $adminManager = AdminManager::getInstance();            
                $user = $userManager->getUserById($_SESSION['user_id']);

                if ($user['admin'] == 'admin' || $user['admin'] == 'superadmin') {
                    $adminManager->deleteIngredient($_POST['name_delete_ingredient']);
                    echo $this->redirect('admin');
                }
                else {
                    echo $this->redirect('home');
                }
            }
        }
        else {
            echo $this->redirect('login');
        }
    }


}