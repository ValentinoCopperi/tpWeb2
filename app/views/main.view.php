<?php

class mainView {
    public function showProducts($products, $categorias) {
        require 'templates/productList.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}