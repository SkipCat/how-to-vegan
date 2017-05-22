<?php

namespace Model;

class UserManager {
    private $DBManager;
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new UserManager();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->DBManager = DBManager::getInstance();
    }

    public function getUserById($id) {
        $id = (int)$id;
        $data = $this->DBManager->findOne("SELECT * FROM users WHERE id = ".$id);
        return $data;
    }
    
    public function getUserByUsername($username) {
        $data = $this->DBManager->findOneSecure("SELECT * FROM users WHERE username = :username",
            ['username' => $username]);
        return $data;
    }

    public function userCheckRegister($data) {
        if (empty($data['username']) OR empty($data['email']) OR empty($data['password'])) {
            return false;
        }
        $data = $this->getUserByUsername($data['username']);
        if ($data !== false) {
            return false;
        }
        // TODO : Check valid email
        return true;
    }

    private function userHash($pass) {
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        return $hash;
    }
    
    public function userRegister($data) {
        $user['username'] = $data['username'];
        $user['email'] = $data['email'];
        if ($data['password'] == $data['confirm-password']) {
            $user['password'] = $this->userHash($data['password']); 
        }
        $user['address'] = $data['address'];
        $user['birthdate'] = $data['birthdate'];              
        $user['gender'] = $data['gender'];
        $user['admin'] = null;
        $this->DBManager->insert('users', $user);
        var_dump($user);
    }

    public function userCheckLogin($data) {
        if (empty($data['username']) OR empty($data['password'])) {
            return false;
        }
        $user = $this->getUserByUsername($data['username']);
        if ($user === false) {
            return false;
        }
        $pass = $data['password'];
        if (!password_verify($pass, $user['password'])) {
            return false;
        }
        return true;
    }
    
    public function userLogin($username) {
        $data = $this->getUserByUsername($username);
        if ($data === false) {
            return false;
        }
        $_SESSION['user_id'] = $data['id'];
        return true;
    }

    public function editProfile($data) {
        $user = $this->getUserById($_SESSION['user_id']);
        if (empty($data['old-pass']) || empty($data['new-pass'])) {
            $pass = $user['password'];
        }
        else {
            if (password_verify($data['old-pass'], $user['password'])) {
                $pass = $this->userHash($data['new-pass']);
            }
            else {
                return false;
            }
        }

        $query = $this->DBManager->findOneSecure("UPDATE users SET 
            username = :username,
            email = :email, 
            password = :password,
            gender = :gender, 
            birthdate = :birthdate, 
            address = :address
            WHERE id = :id",
            [
                'username'  => $data['username'],
                'email'     => $data['email'],
                'password'  => $pass,
                'gender'    => $data['gender'],
                'birthdate' => $data['birthdate'],
                'address'   => $data['address'],
                'id'        => $_SESSION['user_id']
            ]
        );
        return $query;
    }

    public function userCheckDelete($data) {
        if (empty($data['password'])) {
            return false;
        }
        $user = $this->getUserById($_SESSION['user_id']);
        if ($user === false) {
            return false;
        }
        if (!password_verify($data['password'], $user['password'])) {
            return false;
        }
        return true;
    }

    public function deleteProfile($id) {
        $query = $this->DBManager->findOneSecure("DELETE FROM users WHERE id = :id",
            ['id' => $id]);
        return $query;
    }

    /////////////

    public function getAllRecipes() {
        $data = $this->DBManager->findAllSecure("SELECT * FROM recipes");
        return $data;
    }

    public function getAllBaskets() {
        $data = $this->DBManager->findAllSecure("SELECT * FROM baskets");
        return $data;
    }

    public function getAllIngredients(){
        $data = $this->DBManager->findAllSecure("SELECT * FROM ingredients");
        return $data;
    }

    public function getAllLists($username) {
        $data = $this->DBManager->findAllSecure("SELECT * FROM lists WHERE username = :username", 
            ['username' => $username]);
        foreach ($data AS $key => $list) {
            $list['content'] = explode(',', $list['content']);
        }
        return $data;
    }

    public function pinList($data) {
        $user = $this->getUserById($_SESSION['user_id']);
        $list['name'] = $data['listname'];
        $list['content'] = $data['list-content'];
        $list['date'] = date('d/m/Y h:i:s a', time()); // current date
        $list['username'] = $user['username'];
        $this->DBManager->insert('lists', $list);
    }

    public function deleteList($name) {
        $query = $this->DBManager->findOneSecure("DELETE FROM lists WHERE name = :name",
            ['name' => $name]);
        return $query;
    }

    public function pinRecipe($data) {
        $user = $this->getUserById($_SESSION['user_id']);
        $favorite['id_recipe'] = $data['id_recipe'];
        $favorite['name'] = $data['name'];
        $favorite['username'] = $user['username'];
        $this->DBManager->insert('favorites', $favorite);
    }

    public function getFavorites($username) {
        $data = $this->DBManager->findAllSecure("SELECT * FROM recipes
            LEFT JOIN favorites
            ON recipes.id = favorites.id_recipe 
            WHERE username = :username", ['username' => $username]
        );
        return $data;
    }

    public function deleteFavorite($id) {
        $query = $this->DBManager->findOneSecure("DELETE FROM favorites WHERE id = :id",
            ['id' => $id]);
        return $query;
    }
}
