<?php

class authView {
    public function showLogin($error = null) {
        require './templates/login.phtml';
    }
}