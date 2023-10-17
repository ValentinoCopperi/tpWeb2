<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';


class authController {
    private $authView;
    private $userModel;
    private $authHelper;

    function __construct() {
        $this->authView = new authView();
        $this->userModel = new userModel();
        $this->authHelper = new authHelper();
    }

    public function showLogin() {
        $this->authView->showLogin();
    }

    public function auth() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $this->authView->showLogin('Faltan completar datos');
            return;
        }

        $user = $this->userModel->getByUsername($username);
        if ($user && password_verify($password, ($user->contraseña))) {         
            
          $this->authHelper->login($user);

            header('Location: ' . BASE_URL . 'admin');
        } else {
            $this->authView->showLogin('Usuario inválido');
        }
    }

    function logout() {
        $this->authHelper->logout();
    }
}
