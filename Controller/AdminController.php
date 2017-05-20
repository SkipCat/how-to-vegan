<?php

namespace Controller;

use Model\UserManager;
use Model\AdminManager;

class AdminController extends BaseController {

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