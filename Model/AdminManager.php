<?php

namespace Model;

class AdminManager {
    private $DBManager;
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null)
            self::$instance = new AdminManager();
        return self::$instance;
    }

    private function __construct() {
        $this->DBManager = DBManager::getInstance();
    }

    public function getAllUsers() {
        $data = $this->DBManager->findAllSecure("SELECT * FROM users");
        return $data;
    }

    public function deleteUser($username) {
        $user = $this->DBManager->findOneSecure("DELETE FROM users WHERE username = :username",
            ['username' => $username]);
        return $user;
    }

    public function addAdmin($username) {
        $user = $this->DBManager->findOneSecure("UPDATE users SET admin = 'admin' WHERE username = :username",
            ['username' => $username]);
        if ($user['admin'] !== 'admin' && $user['admin'] !== 'superadmin') {
            return $user;
        }
        else {
            return false;
        }
    }

    public function removeAdmin($username) {
        $user = $this->DBManager->findOneSecure("UPDATE users SET admin = 'NULL' WHERE username = :username",
            ['username' => $username]);
        if ($user['admin'] !== 'admin' && $user['admin'] !== 'superadmin') {
            return $user;
        }
        else {
            return false;
        }
    }

    public function addRecipe($data) {
        $user['image'] = 'assets/img/' . $_FILES['uploads_file']['name'];
        $user['name'] = $data['name_recipe'];
        $user['category'] = $data['category'];
        $user['preparation'] = $data['preparation'];
        $user['baking'] = $data['baking'];
        $user['ingredients'] = $data['ingredients'];
        $user['recipe'] = $data['recipe'];

        $this->DBManager->insert('recipes', $user);
        move_uploaded_file($_FILES['uploads_file']['tmp_name'], 'assets/img/' . $_FILES['uploads_file']['name']);
    }

    public function addBasket($data) {
        $user['image'] = 'assets/img/' . $_FILES['uploads_file']['name'];
        $user['price'] = $data['price'];
        $user['name'] = $data['name_basket'];
        $user['category'] = $data['category'];
        $user['category_id'] = $data['category_id'];

        $this->DBManager->insert('baskets', $user);
        move_uploaded_file($_FILES['uploads_file']['tmp_name'], 'assets/img/' . $_FILES['uploads_file']['name']);
    }

    public function addIngredient($data) {
        $user['id_basket'] = $data['id_basket'];
        $user['image'] = 'assets/img/' . $_FILES['uploads_file']['name'];
        $user['name'] = $data['name_ingredient'];
        $user['description'] = $data['description'];

        $this->DBManager->insert('ingredients', $user);
        move_uploaded_file($_FILES['uploads_file']['tmp_name'], 'assets/img/' . $_FILES['uploads_file']['name']);
    }

    public function deleteBasket($name_delete_basket) {
        $user = $this->DBManager->findOneSecure("DELETE FROM baskets WHERE name = :name",
            ['name' => $name_delete_basket]);
        return $user;
    }

    public function deleteRecipe($name_delete_recipe) {
        $user = $this->DBManager->findOneSecure("DELETE FROM recipes WHERE name = :name",
            ['name' => $name_delete_recipe]);
        return $user;
    }

    public function deleteIngredient($name_delete_ingredient) {
        $user = $this->DBManager->findOneSecure("DELETE FROM ingredients WHERE name = :name",
            ['name' => $name_delete_ingredient]);
        return $user;
    }

}