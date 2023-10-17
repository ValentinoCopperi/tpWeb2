<?php

class mainView {
    public function showProducts($products, $categorias, $categoriaActual = null) {
        require 'templates/productList.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}
