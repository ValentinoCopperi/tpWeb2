<?php
require_once './app/models/product.model.php';
require_once './app/models/categoria.model.php';
require_once './app/views/main.view.php';
require_once './app/views/product.view.php';
require_once './app/helpers/auth.helper.php';


class productController {
    private $productModel;
    private $categoriaModel;
    private $mainView;
    private $productView;
    private $helper;

    public function __construct() {

        $this->helper = new authHelper();

        $this->helper->checkLogin();


        $this->productModel = new productModel();
        $this->categoriaModel = new categoriaModel();
        $this->mainView = new mainView();
        $this->productView = new productView();
       
    }

    public function showProducts() {
       
        $products = $this->productModel->getProducts();
        $categorias = $this->categoriaModel->getCategorias();
        
        $this->mainView->showProducts($products, $categorias);
    }

    public function showProductByName($name) {
        $product = $this->productModel->getProductByName($name);
        $this->productView->showProduct($product);
    }

    public function showProductsByCategoria($categoria) {
        $products = $this->productModel->getProductsByCategoria($categoria);
        $categorias = $this->categoriaModel->getCategorias();
        $this->mainView->showProducts($products, $categorias);
    }

}