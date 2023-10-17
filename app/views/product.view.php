<?php

class productView {
    public function showProduct($product) {
        require 'templates/product.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}