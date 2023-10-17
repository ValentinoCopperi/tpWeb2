<?php

class adminView {
    public function showAdmin($products, $categorias) {
        require 'templates/admin.phtml';
    }

    public function showEditProduct($product, $categorias) {
        require 'templates/edit.product.phtml';
    }

    public function showEditCategoria($categoria) {
        require './templates/edit.categoria.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}