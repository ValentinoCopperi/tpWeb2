<?php

class authHelper{

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    
    function checkLogin(){
        authHelper::init();
        if(!isset($_SESSION['ID_USER'])){
            header("Location: " . BASE_URL . "login");
            die();
        }
    }

    function login($user){
        authHelper::init();
        $_SESSION['ID_USER'] = $user->id;
        $_SESSION['ID_NAME'] = $user->usuario;
    }

    function logout(){
        authHelper::init();
        session_destroy();
        header("Location: " . BASE_URL . "login");
    }
}