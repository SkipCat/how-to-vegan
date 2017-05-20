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



}